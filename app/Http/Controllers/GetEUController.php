<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Exception;

class GetEUController extends Controller
{
    public static function EU() {
        // Время
        $timestamp = time();

        // Забираем время, которое указали при создании файла
        $lastData = json_decode(Storage::get('euro.json'),TRUE);
        $lastTime = $lastData[0]['Date'];

        // Сравниваем время которое в файле и время которое сейчас
        if($lastTime + (3600 * 99) < $timestamp){

            try{
                $xml = simplexml_load_string(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));
            }catch(\Exception $e){
                return $lastData[1]['EU'];
            }

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
