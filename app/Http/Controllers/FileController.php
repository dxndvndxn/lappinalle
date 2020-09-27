<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function kek(Request $request) {
        $data = $request->all();
        $id= $data['id'];
        $name = $data['name'];
        $tel = $data['tel'];
        $email = $data['email'];
        $adres = $data['adres'];
        $del = $data['del'];
        $comment = $data['comment'];
        $kor = $data['korzina'];
        $total = $data['total_price'];
        $payment = $data['paymentName'];
        $whereGet = $data['whereGet'];
        $passport = $data['passport'];
        $status = $data['status'];
        $dataOrder = $data['data'];
        $korzina = "";

        foreach ($kor as $val) {
            $korzina .= "$val \n";
        }

        $html = "
                 <!DOCTYPE html>
                 <html lang='ru'>
                    <head>
                        <meta charset=\"utf-8\">
                    </head>
                    <body>
                        <h1>Заказ №$id</h1>
                        <p>Фио: $name</p>
                        <p>Телефон: $tel</p>
                        <p>E-mail: $email</p>
                        <p>Паспортные данные: $passport</p>
                        <p>Адрес доставки: $adres</p>
                        <p>Способ доставки: $del</p>
                        <p>До куда: $whereGet</p>
                        <p>Комментарий: $comment</p>
                        <p>Способ оплаты: $payment</p>
                        <p>Время: $dataOrder</p>
                        <p>Статус: $status</p>
                        <h2>Товары:</h2>
                        <p>$korzina<p>
                        <p>Итого: $total</p>
                    </body>
                 </html>";


        File::put(public_path()."/orders/Order_$id.html", $html);
//            $file = public_path()."/orders/Order_$id.html";
//            header("Content-Type: application/octet-stream");
//            header("Accept-Ranges: bytes");
//            header("Content-Length: ".filesize($file));
//            header("Content-Disposition: attachment; filename=".$file);
//            readfile($file);
//            header('Location:' . public_path()."\orders\Order_$id.html");
        return "\orders\Order_$id.html";
    }
}
