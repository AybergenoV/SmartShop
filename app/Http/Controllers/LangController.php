<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function set(Request $request, $lang){
        if(in_array($lang, ['uz', 'qr', 'ru'])){
            App::setLocale($lang);
        }
        $cookie = cookie('lang', $lang, 60*24*365);
        return \back()->withCookie($cookie);
    }
}
