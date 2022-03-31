<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Cash;
use App\Models\Admin;
use App\Models\Profit;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\Basket;

class AuthorizationController extends Controller
{
    public function login(Request $request){
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

        $pincode = md5($request->pincode);
        $admin = Admin::where('pincode', $pincode)->first();
        if($admin){
            $token = $admin->createToken($request->header('User-Agent'))->plainTextToken;
            return BaseController::response(true, 'successful login', ['role'=>$admin->role, 'name'=>$admin->name, 'token'=>$token]);
        }
        return BaseController::response(false, 'incorrect pincode', [], 401);
    }

    public function getme(Request $request){
        return $request->user();
    }

    public function salary(Request $request){
        $admin_id = $request->id;
        $admin = $request->user();
        $year = date('Y');
        $month = 1;
        $year = Carbon::create($year, $month);
        $start_year = $year->startOfYear()->format('Y-m-d');
        $salary = Salary::where('admin_id', $admin->id)->where('date', '>=', $start_year)->get(['month', 'salary']);

        $final = [
            'admin_name'=> $admin->name,
            'start'=> $start_year,
            'end'=> date('Y-m-d'),
            'salary'=> $salary->where('month', date('m'))->first()->salary ?? 0,
            'data'=>$salary->toArray()
        ];
        return BaseController::response(true, 'successful', $final);
    }

    public function daily(Request $request){
        $date = $request->date ?? Carbon::today();
        $baskets = Basket::whereDate('created_at', $date)->get();
        $card = $baskets->sum('card');
        $cash = $baskets->sum('cash');
        $debt = $baskets->sum('debt');
        $price = $baskets->sum('price');
        $count = $baskets->count();

        $data = [
            'card'=> $card,
            'cash'=> $cash,
            'debt'=> $debt,
            'sum'=> $price,
            'basket_count'=> $count,
        ];
        return BaseController::response(true, 'successful', $data);
    }
}
