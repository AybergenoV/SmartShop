<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Cash;
use App\Models\Admin;
use App\Models\Profit;
use App\Models\Consumption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Consumption_category;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class ConsumptionController extends Controller
{
    public function createCategory(Request $request){
        $name = $request->name;
        $category = Consumption_category::where('name', $name)->first();
        if(!isset($category)){
            $category = Consumption_category::create([
                'name'=> $name
            ]);
        }else{
            return BaseController::response(\false, 'Olin unday kategorya bor edi.');
        }
        return BaseController::response(\true, 'successful', ['id'=>$category->id]);
    }
    public function categories(Request $request){
        $categories = Consumption_category::all(['id', 'name']);
        return BaseController::response(true, 'successfull', $categories->toArray());
    }
    public function consumption(Request $request){
        $validation = Validator::make($request->all(), [
            'category_id'=> 'required|integer',
            'date'=> 'required|date',
            'price'=> 'required',
            'description'=> 'required|max:255',
            'staff'=> 'nullable',
            'type'=> 'required'
        ]);
        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }
        $price = $request->price;
        $cash = Cash::now();
        $profit = Profit::orderBy('id', 'desc')->first();
        $balance = Cash::orderBy('id', 'desc')->first();
        if($request->type == 'consumption'){
            $balance->update([
                'balance'=> $cash-$price
            ]);
            $profit->update([
                'balance'=>$profit->balance-$price
            ]);
        }elseif($request->type == 'income'){
            $profit->update([
                'balance'=>$profit->balance+$price
            ]);
            $balance->update([
                'balance'=> $cash+$price
            ]);
        }
        Consumption::create($request->all());
        return BaseController::response(true, 'successful');
    }
    public function staffs(Request $request){
        $staff = Admin::select('id', 'name')->where('id', '!=', $request->user()->id)->get()->toArray();
        return BaseController::response(true, 'all staff', $staff);
    }
    public function getConsumption(Request $request){
        $date = $request->date;
        $to = $request->to;
        $do = $request->do;
        if(!isset($to) or !isset($do)){
            return BaseController::response(false, 'Sana tanlash kerak');
        }
        $type = $request->type ?? 'consumption';
        $consumptions = Consumption::select('consumption_categories.name as category_name', 'consumptions.date', 'consumptions.price', 'consumptions.description', 'consumptions.staff')
            ->join('consumption_categories', 'consumption_categories.id', 'consumptions.category_id')
            ->where('consumptions.type', $type)
            ->whereDate('consumptions.date', '>=', $to)
            ->whereDate('consumptions.date', '<=', $do);
        if(isset($date)){
            $consumptions = $consumptions->where('consumptions.date', $date);
        }
        return BaseController::response(true, 'successful', $consumptions->get()->toArray());
    }

    public function balance(Request $request){
        $to = $request->to ?? date('Y-m-d');
        $do = $request->do ?? date('Y-m-d');
        $balance = Cash::now($to, $do);
        return BaseController::response(true, 'successful', ['balance'=>$balance]);
    }

    public function profit(Request $request){
        $user = $request->user();
        if($user->role != 'ceo'){
            return BaseController::response(false, 'only ceo');
        }
        $to = $request->to ?? date('Y-m-d');
        $do = $request->do ?? date('Y-m-d');
        $balance = Profit::now($to, $do);
        return BaseController::response(true, 'successful', ['balance'=>$balance]);
    }
}
