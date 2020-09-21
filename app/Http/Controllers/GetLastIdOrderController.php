<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetLastIdOrderController extends Controller
{
    public function index(Request $request) {

        return DB::table('orders')->select('orders_id')->orderBy('orders_id', 'desc')->value('orders_id');
    }
}
