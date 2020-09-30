<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
class CheckAmountOfProductController extends Controller
{
    public function CheckAmount(Request $request){
        $answer = [];
        $frontData = json_decode($request['data'], TRUE);

        try {
            foreach($frontData as $value) {
                $amountOfProduct = DB::table('catalog_size')->where('catalog_size_id', $value['catalog_size_id'])->value('catalog_size_amount');
                $checkAmount = $amountOfProduct - $value['amount'];

                if ($checkAmount < 0) {
                    array_push($answer, ['catalog_size_id' => $value['catalog_size_id'], 'amount' => false]);
                }else{
                    array_push($answer, ['catalog_size_id' => $value['catalog_size_id'], 'amount' => true]);
                }
            }
        }catch (Exception $e){
            return $e;
        }

        return $answer;
    }
}
