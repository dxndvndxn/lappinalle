<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class InfernalFilterFromNalimkaAkaTatarinBitchController extends Controller
{
    public function universal(Request $request, $sexalias, $catalias, $depalias, $sortmode, $sale, $min, $max, $sizes) {
        try {

            $sexid = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $sexalias)->value("sex_id");
            $depid = "%";
            $catid = "%";
            $activesale = "%";
            $activesizes = [];

            if ($catalias !== 'null') {
                $catid = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $catalias)->value("categories_id");
            }
            if ($depalias !== 'null') {
                $depid = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $depalias)->value("departments_id");
            }
            if ($sizes !== 'null') {
                $activesizes = explode(',', $sizes);
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
                $min = (int)$min / (int)GetEUController::EU();
                $max = (int)$max / (int)GetEUController::EU();
            }else{
                $min = $productMin;
                $max = $productMax;
            }

            $dataSizes = DB::table('catalog_size')
                ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
                ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
                ->get();
            $sortData = null;
            switch ($sortmode){
                case 'low':
                    if (count($activesizes)){
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $sexid)
                            ->where('categories_id', 'like', $catid)
                            ->where('departments_id', 'like', $depid)
                            ->where('product_sale', 'like', $activesale)
                            ->whereBetween('product_price', [$min, $max])
                            ->orderBy('product_price', 'asc')
                            ->whereIn('product_id', $activesizes)
                            ->paginate(30);
                    }else{
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $sexid)
                            ->where('categories_id', 'like', $catid)
                            ->where('departments_id', 'like', $depid)
                            ->where('product_sale', 'like', $activesale)
                            ->whereBetween('product_price', [$min, $max])
                            ->orderBy('product_price', 'asc')
                            ->paginate(30);
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['min'] = (int)$productMin * (int)GetEUController::EU();
                    $alldata['max'] = (int)$productMax * (int)GetEUController::EU();
                    $alldata['eu'] = (int)GetEUController::EU();
                    return $alldata;
                    break;
                case 'high':
                    if (count($activesizes)){
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $sexid)
                            ->where('categories_id', 'like', $catid)
                            ->where('departments_id', 'like', $depid)
                            ->where('product_sale', 'like', $activesale)
                            ->whereBetween('product_price', [$min, $max])
                            ->orderBy('product_price', 'desc')
                            ->whereIn('product_id', $activesizes)
                            ->paginate(30);
                    }else{
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $sexid)
                            ->where('categories_id', 'like', $catid)
                            ->where('departments_id', 'like', $depid)
                            ->where('product_sale', 'like', $activesale)
                            ->whereBetween('product_price', [$min, $max])
                            ->orderBy('product_price', 'desc')
                            ->paginate(30);
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['min'] = (int)$productMin * (int)GetEUController::EU();
                    $alldata['max'] = (int)$productMax * (int)GetEUController::EU();
                    $alldata['eu'] = (int)GetEUController::EU();
                    return $alldata;
                    break;
                default:
                    if (count($activesizes)){
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $sexid)
                            ->where('categories_id', 'like', $catid)
                            ->where('departments_id', 'like', $depid)
                            ->where('product_sale', 'like', $activesale)
                            ->whereBetween('product_price', [$min, $max])
                            ->whereIn('product_id', $activesizes)
                            ->orderBy('product_id', 'desc')
                            ->paginate(30);
                    }else{
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $sexid)
                            ->where('categories_id', 'like', $catid)
                            ->where('departments_id', 'like', $depid)
                            ->where('product_sale', 'like', $activesale)
                            ->orderBy('product_id', 'desc')
                            ->whereBetween('product_price', [$min, $max])
                            ->paginate(30);
                    }
                    $alldata['myData'] = $sortData;
                    $alldata['sizes'] = $dataSizes;
                    $alldata['min'] = (int)$productMin * (int)GetEUController::EU();
                    $alldata['max'] = (int)$productMax * (int)GetEUController::EU();
                    $alldata['eu'] = (int)GetEUController::EU();
                    return $alldata;
                    break;

            }

//            if ($depid != NULL) {
//                $dataSizes = DB::table('catalog_size')
//                    ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
//                    ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
//                    ->get();
//                $productMin = DB::table('products')
//                    ->where('product_available', '=', 1)
//                    ->where('sex_id', '=', $sexid)
//                    ->where('departments_id', '=', $depid)
//                    ->where('categories_id', '=', $catid)
//                    ->min('product_price');
//                $productMax = DB::table('products')
//                    ->where('product_available', '=', 1)
//                    ->where('sex_id', '=', $sexid)
//                    ->where('departments_id', '=', $depid)
//                    ->where('categories_id', '=', $catid)
//                    ->max('product_price');
//                switch ($sortmode){
//                    case 'low':
//                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
//                            ->where('product_available', '=', 1)
//                            ->where('sex_id', '=', $sexid)
//                            ->where('categories_id', '=', $catid)
//                            ->where('departments_id', '=', $depid)
//                            ->where('product_sale', 'like', $activesale)
//                            ->whereBetween('product_price', [$min, $max])
//                            ->orderBy('product_price', 'asc')
//                            ->whereIn('product_id', $activesizes)
//                            ->paginate(30);
//                        $alldata['myData'] = $sortData;
//                        $alldata['sizes'] = $dataSizes;
//                        $alldata['min'] = $productMin;
//                        $alldata['max'] = $productMax;
//                        return $alldata;
//                        break;
//                    case 'high':
//                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
//                            ->where('product_available', '=', 1)
//                            ->where('sex_id', '=', $sexid)
//                            ->where('categories_id', '=', $catid)
//                            ->where('departments_id', '=', $depid)
//                            ->where('product_sale', '=', $activesale)
//                            ->whereBetween('product_price', [$min, $max])
//                            ->orderBy('product_price', 'desc')
//                            ->whereIn('product_id', $activesizes)
//                            ->paginate(30);
//                        $alldata['myData'] = $sortData;
//                        $alldata['sizes'] = $dataSizes;
//                        $alldata['min'] = $productMin;
//                        $alldata['max'] = $productMax;
//                        return $alldata;
//                        break;
//                }
//            }
//            elseif($catid != NULL){
//                $dataSizes = DB::table('catalog_size')
//                    ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
//                    ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
//                    ->where('sex_id', '=', $sexid)
//                    ->where('categories_id', '=', $catid)
//                    ->get();
//                $productMin = DB::table('products')
//                    ->where('product_available', '=', 1)
//                    ->where('sex_id', '=', $sexid)
//                    ->where('categories_id', '=', $catid)
//                    ->min('product_price');
//                $productMax = DB::table('products')
//                    ->where('product_available', '=', 1)
//                    ->where('sex_id', '=', $sexid)
//                    ->where('categories_id', '=', $catid)
//                    ->max('product_price');
//                switch ($sortmode){
//                    case 'low':
//                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
//                            ->where('product_available', '=', 1)
//                            ->where('sex_id', '=', $sexid)
//                            ->where('categories_id', '=', $catid)
//                            ->where('product_sale', '=', $activesale)
//                            ->whereBetween('product_price', [$min, $max])
//                            ->orderBy('product_price', 'asc')
//                            ->whereIn('product_id', $activesizes)
//                            ->paginate(30);
//                        $alldata[0] = $dataSizes;
//                        $alldata[1] = $productMin;
//                        $alldata[2] = $productMax;
//                        $alldata[3] = $sortData;
//                        return $alldata;
//                        break;
//                    case 'high':
//                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
//                            ->where('product_available', '=', 1)
//                            ->where('sex_id', '=', $sexid)
//                            ->where('categories_id', '=', $catid)
//                            ->where('product_sale', '=', $activesale)
//                            ->whereBetween('product_price', [$min, $max])
//                            ->orderBy('product_price', 'desc')
//                            ->whereIn('product_id', $activesizes)
//                            ->paginate(30);
//                        $alldata[0] = $dataSizes;
//                        $alldata[1] = $productMin;
//                        $alldata[2] = $productMax;
//                        $alldata[3] = $sortData;
//                        return $alldata;
//                        break;
//                }
//            }
//            elseif($sexid != NULL){
//                $dataSizes = DB::table('catalog_size')
//                    ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
//                    ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
//                    ->where('sex_id', '=', $sexid)
//                    ->get();
//                $productMin = DB::table('products')
//                    ->where('product_available', '=', 1)
//                    ->where('sex_id', '=', $sexid)
//                    ->min('product_price');
//                $productMax = DB::table('products')
//                    ->where('product_available', '=', 1)
//                    ->where('sex_id', '=', $sexid)
//                    ->max('product_price');
//                switch ($sortmode){
//                    case 'low':
//                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
//                            ->where('product_available', '=', 1)
//                            ->where('sex_id', '=', $sexid)
//                            ->where('product_sale', '=', $activesale)
//                            ->whereBetween('product_price', [$min, $max])
//                            ->orderBy('product_price', 'asc')
//                            ->whereIn('product_id', $activesizes)
//                            ->paginate(30);
//                        $alldata[0] = $dataSizes;
//                        $alldata[1] = $productMin;
//                        $alldata[2] = $productMax;
//                        $alldata[3] = $sortData;
//                        return $alldata;
//                        break;
//                    case 'high':
//                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
//                            ->where('product_available', '=', 1)
//                            ->where('sex_id', '=', $sexid)
//                            ->where('product_sale', '=', $activesale)
//                            ->whereBetween('product_price', [$min, $max])
//                            ->orderBy('product_price', 'desc')
//                            ->whereIn('product_id', $activesizes)
//                            ->paginate(30);
//                        $alldata[0] = $dataSizes;
//                        $alldata[1] = $productMin;
//                        $alldata[2] = $productMax;
//                        $alldata[3] = $sortData;
//                        return $alldata;
//                        break;
//                }
//            }
        }catch (\Exception $e){
            return $e;
        }
    }
}
