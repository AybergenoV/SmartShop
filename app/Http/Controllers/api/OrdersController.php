<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Cash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Basket;
use App\Models\Orders;
use App\Models\Warehouse;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Prodact;
use App\Models\Profit;
use App\Models\Salary;
use App\Models\usd;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index(Request $request){
        $to = $request->to ?? Carbon::today();
        $do = $request->do ?? Carbon::today();
        $final = [];
        $baskets = Basket::where('is_deleted', false)
            ->whereDate('created_at', '>=', $to)
            ->whereDate('created_at', '<=', $do)->get();
        foreach ($baskets as $basket) {
            $user = User::find($basket->client_id);
            $orders = Orders::select('orders.id as order_id', 'prodacts.id as product_id', 'prodacts.name as product_name',
                'prodacts.brand as product_brand', 'orders.count', 'orders.price')
                ->join('prodacts', 'prodacts.id', 'orders.product_id')
                ->where('orders.basket_id', $basket->id)
                ->get();
            $final[] = [
                'client_id'=> $user->id,
                'client_name'=> $user->full_name,
                'phone'=> $user->phone,
                'vendor_name'=> Admin::find($basket->admin_id)->name,
                'basket'=> [
                    'id'=> $basket->id,
                    'card'=> $basket->card,
                    'cash'=> $basket->cash,
                    'debt'=> $basket->debt,
                    'price'=> $basket->price,
                    'term'=> $basket->term,
                    'description'=> $basket->description,
                    'is_deleted'=> $basket->is_deleted,
                    'created_at'=> date_format($basket->created_at, 'Y-m-d H:i:s')
                ],
                'orders'=> $orders
            ];
        }
        return BaseController::response(\true, 'successful', $final);
    }

    public function create(Request $request){
        $validation = Validator::make($request->all(), [
            'client_id'=> 'required',
            'card'=>'required',
            'cash'=>'required',
            'debt'=>'required',
            'term'=>'nullable',
            'description'=>'nullable',
            'orders.*.product_id'=>'required|exists:App\Models\Prodact,id',
            'orders.*.count'=>'required',
            'orders.*.price'=>'required'
        ]);
        $clinet_id = $request->client_id != 0 ? $request->client_id: 17;
        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }
        foreach ($request->orders as $order) {
            $warehouse = Warehouse::orderBy('id', 'desc')->where('product_id', $order['product_id'])->first();
            $remained = $warehouse->remained ?? 0;
            if($remained - $order['count'] < 0){
                return BaseController::response(false, 'товара недостаточно');
            }
        }
        $basket = Basket::create([
            'admin_id'=> $request->user()->id,
            'client_id'=> $clinet_id,
            'card'=> $request->card,
            'cash'=> $request->cash,
            'debt'=> $request->debt,
            'price'=> $request->card+$request->cash+$request->debt,
            'term'=> $request->term,
            'description'=> $request->description,
        ]);
        $cost_price = 0;
        foreach ($request->orders as $order) {
            $warehouse = Warehouse::orderBy('id', 'desc')->where('product_id', $order['product_id'])->first();
            $remained = $warehouse->remained ?? 0;
            $warehouse->update([
                'remained'=> $remained-$order['count'],
                'sold_out'=> $warehouse->sold_out+$order['count'],
            ]);
            Orders::create([
                'client_id'=>$clinet_id,
                'basket_id'=>$basket->id,
                'product_id'=>$order['product_id'],
                'count'=> $order['count'],
                'price'=> $order['price']
            ]);
            $usd = usd::first();
            $product = Prodact::find($order['product_id'])->cost_price*$usd->usd;
            $cost_price += $product*$order['count'];
        }
        $user = User::find($clinet_id);
        $balance = Cash::orderBy('id', 'desc')->first();
        $profit = Profit::orderBy('id', 'desc')->first();
        if($request->debt > 0){
            $user->update([
                'balance'=> $user->balance - $request->debt,
            ]);
        }

        Transaction::create([
            'title'=>'заказ',
            'card'=> $request->card,
            'cash'=> $request->cash,
            'debt'=> $request->debt,
            'basket_id'=>$basket->id,
            'price'=> $request->card+$request->cash+$request->debt,
            'from_whom'=>'продавец',
            'from_id'=> $request->user()->id,
            'to_whom'=> 'покупатель',
            'to_id'=> $user->id
        ]);
        $update_price = isset($balance->balance) ? $balance->balance+($request->card+$request->cash):($request->card+$request->cash);
        $balance->update([
            'balance'=> $update_price,
        ]);
        $profit_balance = $profit->balance ?? 0;
        $profit->update([
            'balance'=> $profit_balance+($request->card+$request->cash+$request->debt-$cost_price),
        ]);
        $id = $request->user()->id;
        $admin_flex = Admin::find($id)->flex;
        $new_salary = (($request->card+$request->cash+$request->debt)*$admin_flex)/100;
        $salary = Salary::where('admin_id', $id)->where('month', date('m'))->where('year', \date('Y'))->first();
        if($salary){
            $salary->update([
                'salary'=> $salary->salary+$new_salary,
            ]);
        }else{
            Salary::create([
                'admin_id'=> $id,
                'month'=> date('m'),
                'year'=> date('Y'),
                'salary'=> $new_salary,
                'date'=> date('Y-m-d')
            ]);
        }
        return BaseController::response(true, 'successful', ['basket_id'=>$basket->id]);
    }
}
