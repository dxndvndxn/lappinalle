<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index(Request $request) {

        $dbusers = DB::table('lappiusers')->get();

        $users = [null];
        $i=0;
        $j=0;

        foreach ($dbusers as $val){
            $users[$i] = (array) $val;
            $i++;
        }

        $users_adm = [null];

        foreach ($users as $val){
            $users_adm[$j][0] = $val['lappiusers_id'];
            $users_adm[$j][1] = $val['lappiusers_name'];
            $users_adm[$j][2] = $val['lappiusers_tel'];
            $users_adm[$j][3] = $val['lappiusers_email'];
            $j++;
        }

        return $users_adm;

    }
}
