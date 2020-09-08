<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class GetEUController extends Controller
{
    public static function EU($URI) {

        $xml = simplexml_load_string(file_get_contents($URI));

        //Возвращаем json
        $json = json_encode($xml);

        //Возвращаем массив
        $array = json_decode($json,TRUE);

        $currentEU = $array['Valute'][11]['Value'];

        return $currentEU;
    }
}
