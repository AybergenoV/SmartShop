<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Admin;
use App\Models\Profit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller{

    public function login(Request $request){
        $token = $request->cookie('token');
        if($token){
            $explode = \explode('|', $token)[0];
            $db = DB::table('personal_access_tokens')->where('id', $explode)->first();
            if($db){
                return \redirect()->route('web.index');
            }
            Cookie::queue(Cookie::forget('token'));
        }
        return \view('admin.login');
    }

    public function Checklogin(Request $request){
        $balance = Cash::orderBy('id', 'desc')->first();
        $cash_time = date('Y-m-d', strtotime($balance->created_at));
        if($cash_time != date('Y-m-d')){
            $balance = Cash::create(['balance'=>0]);
        }

        $profit = Profit::orderBy('id', 'desc')->first();
        $profit_time = date('Y-m-d', strtotime($profit->created_at));
        if($profit_time != date('Y-m-d')){
            $profit = Profit::create(['balance'=>0]);
        }
        $to = ['(', ')', '-'];
        $do = ['','',''];
        $phone = str_replace($to, $do, $request->phone);
        $password = md5($request->password);


        $user = Admin::where('phone', $phone)->first();
        if(!$user or $user->pincode != $password){
            return \back()->with('error', 'номер или пароль неверный');
        }

        $token = $user->createToken($request->header('User-Agent'))->plainTextToken;
        $cookie = cookie('token', $token, 60*24*365);
        return redirect()->route('web.index')->withCookie($cookie);
    }

    public function logout(){
        Cookie::queue(Cookie::forget('token'));
        return back();
    }
}
