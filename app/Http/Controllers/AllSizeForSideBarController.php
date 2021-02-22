<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AllSizeForSideBarController extends Controller
{
    //на вход названия пола, категории и подкатегории
    public function index(Request $request, $sexalias, $depalias, $catalias) {

        $sexid = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $sexalias)->value("sex_id"); //id пола

        $catid = NULL;
        $depid = NULL;

        if ($catalias !== 'null') {
            $catid = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $catalias)->value("categories_id"); //id категории
        }

        if ($depalias !== 'null') {
            $depid = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $depalias)->value("departments_id"); //id подкатегории
        }

        //id всех товаров в нужном разделе
        $prodData = DB::table('products')->select("product_id")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $sexid)
            ->where('categories_id', 'like', $catid)
            ->where('departments_id', 'like', $depid)
            ->get();

        $actualsizes = array();
        $sizeData = array();

        //поиск всех размеров по товарам в разделе
        foreach ($prodDara as $i) {
            $sizeData = DB::table('catalog_size')->select("sizes_id")
                ->where('product_id', '=', $i)
                ->get();
            foreach ($sizeData as $j) {
                array_push($actualsizes, $j);
            }
        }

        //удаление дубликатов
        $result = array_unique($actualsizes);

        return $result;
    }
}
