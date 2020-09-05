<?php

namespace App\Http\Controllers;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LappiUserController extends Controller
{
    public function gen_token() {
        $token = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
        return $token;
    }

    public function Reg (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:LappiUsers',
            'password' => 'required|min:6'
        ]);

        if ($validator) {
            $data = $request->all();
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            $hpass = password_hash($password, PASSWORD_DEFAULT);

            $token = $this->gen_token();

            $register = DB::table('LappiUsers')->insert(
                [ 'LappiUsers_name' => $name,
                    'LappiUsers_email' => $email,
                    'LappiUsers_password' => $hpass,
                    'LappiUsers_token' => $token
                ]
            );

            if ($register) {
                return $token;
            }
        }else{
            return false;
        }
    }

    public function Log (Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator) {
            $data = $request->all();
            $email = $data['email'];
            $password = $data['password'];
            $serched = DB::table('LappiUsers')->where('LappiUsers_email', '=', $email)->get();

            $newS = null;
            foreach ($serched as $val){
                $newS = (array) $val;
            }

            $vpas = password_verify($password, $newS["LappiUsers_password"]);

            if ($vpas) {
                return $newS["LappiUsers_token"];
            }else{
                return 0;
            }
        }
    }
}
