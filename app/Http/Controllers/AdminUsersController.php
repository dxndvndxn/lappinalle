<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index(Request $request) {

        $dbusers = DB::table('LappiUsers')->get();

        $users = [null];
        $i=0;
        $j=0;

        foreach ($dbusers as $val){
            $users[$i] = (array) $val;
            $i++;
        }

        $users_adm = [null];

        foreach ($users as $val){
            $users_adm[$j][0] = $val['LappiUsers_id'];
            $users_adm[$j][1] = $val['LappiUsers_name'];
            $users_adm[$j][2] = $val['LappiUsers_tel'];
            $users_adm[$j][3] = $val['LappiUsers_email'];
            $j++;
        }

        return $users_adm;

    }
}
