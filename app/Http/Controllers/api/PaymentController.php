<?php

namespace App\Http\Controllers\api;

use App\Models\usd;
use App\Models\Cash;
use App\Models\User;
use Faker\Provider\Base;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function create(Request $request){
        $validation = Validator::make($request->all(), [
            'client_id'=> 'required|exists:App\Models\User,id',
            'cash'=>'required',
            'card'=>'required',
        ]);

        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }
        $user = User::find($request->client_id);
        $sum = $request->cash+$request->card;
        $user->update([
            'balance'=> $user->balance+$sum
        ]);
        $balance = Cash::orderBy('id', 'desc')->first();
        if($balance){
            $balance->update([
                'balance'=> $balance->balance+$sum
            ]);
        }else{
            Cash::create([
                'balance'=> $sum
            ]);
        }
        Transaction::create([
            'title'=>'Payment',
            'type'=> $request->type,
            'price'=> $sum,
            'card'=> $request->card,
            'cash'=> $request->cash,
            'from_whom'=>'продавец',
            'from_id'=> $request->user()->id,
            'to_whom'=> 'покупатель',
            'to_id'=> $user->id
        ]);
        return BaseController::response(true, 'successful');
    }

    public function usd(){
        return BaseController::response(\true, 'successful', ['usd'=>usd::find(1)->usd ?? 0]);
    }

    public function trasactionClientPayment(Request $request){
        $client_id = $request->client_id;
        $user = User::find($client_id);
        if(!$user){
            return BaseController::response(false, 'not client', [], 404);
        }
        $transaction = Transaction::select('admins.name as staff_name', 'transactions.card', 'transactions.cash', 'transactions.created_at')
            ->join('admins', 'admins.id', 'transactions.from_id')
            ->where('transactions.title', 'Payment')
            ->where('transactions.to_id', $client_id)
            ->get();
        return BaseController::response(true, 'all', $transaction->toArray());
    }
}
