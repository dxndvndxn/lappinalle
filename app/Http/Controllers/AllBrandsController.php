<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AllBrandsController extends Controller
{
    public function getAllBrands(Request $request){
        return DB::table('brands')->get();
    }
    public function manageAllBrands(Request $request){
        $manageBrand = $request['add'];

        if ($manageBrand){
            DB::table('brands')->insert(['brands_name' => $request['newBrand']]);
            return true;
        }else {
            DB::table('brands')->where('brands_id', '=', $request['id'])->delete();
            return true;
        }
    }
}
