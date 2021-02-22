<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class InfernalFilterFromNalimkaAkaTatarinBitchController extends Controller
{
    public function universal(Request $request, $sexalias, $catalias, $depalias, $sortmode, $sale, $min, $max, $sizes, $brands)
    {
        try {

            $sexid = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $sexalias)->value("sex_id");
            $depid = "%";
            $catid = "%";
            $activesale = "%";
            $activesizes = [];

            $activebrands = [];
            $realEU = (int)GetEUController::EU();

            if ($catalias !== 'null') {
                $catid = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $catalias)->value("categories_id");
            }
            if ($depalias !== 'null') {
                $depid = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $depalias)->value("departments_id");
            }
            if ($sizes !== 'null') {
                $activesizes = explode(',', $sizes);
            }
            if ($brands !== 'null') {
                $brandsname = explode(',', $brands);
                $activebrands = DB::table('brands')->whereIn('brands_name', $brandsname)->select('brands_id')->get();
                $activeBrandsId = [];

                foreach($activebrands as $brandId => $value){
                 array_push($activeBrandsId, (array)$value);
                }

                $activebrands = array_column($activeBrandsId, 'brands_id');
            }
            if ($sale !== 'null') {
                $activesale = 1;
            }
            
            $productMin = DB::table('products')
                ->where('product_available', '=', 1)
                ->where('sex_id', '=', $sexid)
                ->where('departments_id', 'like', $depid)
                ->where('categories_id', 'like', $catid)
                ->min('product_price');
            $productMax = DB::table('products')
                ->where('product_available', '=', 1)
                ->where('sex_id', '=', $sexid)
                ->where('departments_id', 'like', $depid)
                ->where('categories_id', 'like', $catid)
                ->max('product_price');

            if ($min !== 'null' && $max !== 'null') {
                $min = (int)$min / $realEU;
                $max = (int)$max / $realEU;
            } else {
                $min = $productMin;
                $max = $productMax;
            }

            $dataSizes = DB::table('catalog_size')
                ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
                ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
                ->get();

            $dataBrands = DB::table('brands')->select('brands_name')->get();

            $sortData = null;

            switch ($sortmode) {
                case 'low':
                    if (count($activesizes)) {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_price', 'asc')
                                ->whereIn('product_id', $activesizes)
                                ->whereIn('brands_id', $activebrands)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_price', 'asc')
                                ->whereIn('product_id', $activesizes)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        }
                    } else {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereIn('brands_id', $activebrands)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_price', 'asc')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price",
                                "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_price', 'asc')
                                ->paginate(30);
                        }
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['brands'] = $dataBrands;
                    $alldata['min'] = (int)$productMin * $realEU;
                    $alldata['max'] = (int)$productMax * $realEU;
                    $alldata['eu'] = $realEU;
                    return $alldata;
                    break;
                case 'high':
                    if (count($activesizes)) {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_price', 'desc')
                                ->whereIn('product_id', $activesizes)
                                ->whereIn('brands_id', $activebrands)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_price', 'desc')
                                ->whereIn('product_id', $activesizes)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        }
                    } else {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereIn('brands_id', $activebrands)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_price', 'desc')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_price', 'desc')
                                ->paginate(30);
                        }
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['brands'] = $dataBrands;
                    $alldata['min'] = (int)$productMin * $realEU;
                    $alldata['max'] = (int)$productMax * $realEU;
                    $alldata['eu'] = $realEU;
                    return $alldata;
                    break;
                case 'new':
                    if (count($activesizes)) {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_position', 'desc')
                                ->whereIn('product_id', $activesizes)
                                ->whereIn('brands_id', $activebrands)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price","product_img", "product_old_price", 'sex.sex_alias')
                                    ->where('product_available', '=', 1)
                                    ->where('products.sex_id', '=', $sexid)
                                    ->where('products.categories_id', 'like', $catid)
                                    ->where('products.departments_id', 'like', $depid)
                                    ->where('product_sale', 'like', $activesale)
                                    ->whereBetween('product_price', [$min, $max])
                                    ->orderBy('product_position', 'desc')
                                    ->whereIn('product_id', $activesizes)
                                    ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                    ->paginate(30);
                        }
                    } else {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereIn('brands_id', $activebrands)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_position', 'desc')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_position', 'desc')
                                ->paginate(30);
                        }
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['brands'] = $dataBrands;
                    $alldata['min'] = (int)$productMin * $realEU;
                    $alldata['max'] = (int)$productMax * $realEU;
                    $alldata['eu'] = $realEU;
                    return $alldata;
                    break;
                default:
                    if (count($activesizes)) {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_position', 'asc')
                                ->whereIn('product_id', $activesizes)
                                ->whereIn('brands_id', $activebrands)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->orderBy('product_position', 'asc')
                                ->whereIn('product_id', $activesizes)
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->paginate(30);
                        }
                    } else {
                        if (count($activebrands)) {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereIn('brands_id', $activebrands)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_position', 'asc')
                                ->paginate(30);
                        } else {
                            $sortData = DB::table('products')->select("product_id", "product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
                                ->where('product_available', '=', 1)
                                ->where('products.sex_id', '=', $sexid)
                                ->where('products.categories_id', 'like', $catid)
                                ->where('products.departments_id', 'like', $depid)
                                ->where('product_sale', 'like', $activesale)
                                ->whereBetween('product_price', [$min, $max])
                                ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
                                ->orderBy('product_position', 'asc')
                                ->paginate(30);
                        }
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['brands'] = $dataBrands;
                    $alldata['min'] = (int)$productMin * $realEU;
                    $alldata['max'] = (int)$productMax * $realEU;
                    $alldata['eu'] = $realEU;
                    return $alldata;
                    break;
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}





//---------------- OLD -------------------
// namespace App\Http\Controllers;
// use DB;
// use Illuminate\Http\Request;

// class InfernalFilterFromNalimkaAkaTatarinBitchController extends Controller
// {
//     public function universal(Request $request, $sexalias, $catalias, $depalias, $sortmode, $sale, $min, $max, $sizes) {
//         try {

//             $sexid = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $sexalias)->value("sex_id");
//             $depid = "%";
//             $catid = "%";
//             $activesale = "%";
//             $activesizes = [];
//             $realEU = (int)GetEUController::EU();

//             if ($catalias !== 'null') {
//                 $catid = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $catalias)->value("categories_id");
//             }
//             if ($depalias !== 'null') {
//                 $depid = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $depalias)->value("departments_id");
//             }
//             if ($sizes !== 'null') {
//                 $activesizes = explode(',', $sizes);
//             }
//             if ($sale !== 'null') {
//                 $activesale = 1;
//             }
//             $productMin = DB::table('products')
//                 ->where('product_available', '=', 1)
//                 ->where('sex_id', '=', $sexid)
//                 ->where('departments_id', 'like', $depid)
//                 ->where('categories_id', 'like', $catid)
//                 ->min('product_price');
//             $productMax = DB::table('products')
//                 ->where('product_available', '=', 1)
//                 ->where('sex_id', '=', $sexid)
//                 ->where('departments_id', 'like', $depid)
//                 ->where('categories_id', 'like', $catid)
//                 ->max('product_price');

//             if ($min !== 'null' && $max !== 'null') {
//                 $min = (int)$min / $realEU;
//                 $max = (int)$max / $realEU;
//             }else{
//                 $min = $productMin;
//                 $max = $productMax;
//             }

//             $dataSizes = DB::table('catalog_size')
//                 ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
//                 ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
//                 ->get();
//             $sortData = null;
//             switch ($sortmode){
//                 case 'low':
//                     if (count($activesizes)){
//                         $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->whereBetween('product_price', [$min, $max])
//                             ->orderBy('product_price', 'asc')
//                             ->whereIn('product_id', $activesizes)
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->paginate(30);
//                     }else{
//                         $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->whereBetween('product_price', [$min, $max])
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->orderBy('product_price', 'asc')
//                             ->paginate(30);
//                     }
//                     $alldata['myData'] = $sortData;
//                     $alldata['sizes'] = $dataSizes;
//                     $alldata['min'] = (int)$productMin * $realEU;
//                     $alldata['max'] = (int)$productMax * $realEU;
//                     $alldata['eu'] = $realEU;
//                     return $alldata;
//                     break;
//                 case 'high':
//                     if (count($activesizes)){
//                         $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->whereBetween('product_price', [$min, $max])
//                             ->orderBy('product_price', 'desc')
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->whereIn('product_id', $activesizes)
//                             ->paginate(30);
//                     }else{
//                         $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->whereBetween('product_price', [$min, $max])
//                             ->orderBy('product_price', 'desc')
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->paginate(30);
//                     }
//                     $alldata['myData'] = $sortData;
//                     $alldata['sizes'] = $dataSizes;
//                     $alldata['min'] = (int)$productMin * $realEU;
//                     $alldata['max'] = (int)$productMax * $realEU;
//                     $alldata['eu'] = $realEU;
//                     return $alldata;
//                     break;
//                     case 'new':
//                         if (count($activesizes)){
//                             $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->whereBetween('product_price', [$min, $max])
//                             ->whereIn('product_id', $activesizes)
//                             ->orderBy('product_id', 'desc')
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->paginate(30);
//                         }else{
//                             $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->orderBy('product_id', 'desc')
//                             ->whereBetween('product_price', [$min, $max])
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->paginate(30);
//                         }
//                             $alldata['myData'] = $sortData;
//                             $alldata['sizes'] = $dataSizes;
//                             $alldata['min'] = (int)$productMin * $realEU;
//                             $alldata['max'] = (int)$productMax * $realEU;
//                             $alldata['eu'] = $realEU;
//                             return $alldata;
//                     break;
//                 default:
//                     if (count($activesizes)){
//                         $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->whereBetween('product_price', [$min, $max])
//                             ->whereIn('product_id', $activesizes)
//                             ->orderBy('product_id', 'asc')
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->paginate(30);
//                     }else{
//                         $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
//                             ->where('product_available', '=', 1)
//                             ->where('products.sex_id', '=', $sexid)
//                             ->where('products.categories_id', 'like', $catid)
//                             ->where('products.departments_id', 'like', $depid)
//                             ->where('product_sale', 'like', $activesale)
//                             ->orderBy('product_id', 'asc')
//                             ->whereBetween('product_price', [$min, $max])
//                             ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
//                             ->paginate(30);
//                     }
//                     $alldata['myData'] = $sortData;
//                     $alldata['sizes'] = $dataSizes;
//                     $alldata['min'] = (int)$productMin * $realEU;
//                     $alldata['max'] = (int)$productMax * $realEU;
//                     $alldata['eu'] = $realEU;
//                     return $alldata;
//                     break;

//             }
//         }catch (\Exception $e){
//             return $e;
//         }
//     }
// }
