<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cash;
use App\Models\Profit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
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
        $lang = $request->cookie('lang');
        if($lang == 'uz'){
            App::setLocale('uz');
        }elseif ($lang == 'qr') {
            App::setLocale('qr');
        }else{
            App::setLocale('ru');
            $request->session()->put('lang', '');
        }
        return $next($request);
    }
}
