<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddProductController extends Controller
{
    public function index(Request $request){
        return $request->all();
    }
}
