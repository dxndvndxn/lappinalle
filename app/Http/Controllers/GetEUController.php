<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Exception;

class GetEUController extends Controller
{
    public static function EU($URI) {
        // Время
        $timestamp = time();

        // Забираем время, которое указали при создании файла
        $lastData = json_decode(Storage::get('euro.json'),TRUE);
        $lastTime = $lastData[0]['Date'];

        // Сравниваем время которое в файле и время которое сейчас
        if($lastTime + (3600 * 24) < $timestamp){
            $xml = simplexml_load_string(file_get_contents($URI));

            //Возвращаем json
            $json = json_encode($xml);

            //Возвращаем массив
            $array = json_decode($json,TRUE);

            $currentEU[0]['Date'] = $timestamp;
            $currentEU[1]['EU'] = $array['Valute'][11]['Value'];
            Storage::put('euro.json', json_encode($currentEU));
        }

        return $lastData[1]['EU'];
    }
}
