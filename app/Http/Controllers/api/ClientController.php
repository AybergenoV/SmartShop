<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Admin;
use App\Models\Basket;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function register(Request $request){
        $validation = Validator::make($request->all(), [
            'full_name'=> 'required|max:255',
            'phone'=> 'required|min:9|max:13|unique:App\Models\User,phone',
            'inn'=> 'nullable|min:9|unique:App\Models\User,inn',
            'about'=> 'nullable',
            'user_type'=> 'required'
        ]);

        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }

        $data = [
            'full_name'=> $request->full_name,
            'phone'=> $request->phone,
            'inn'=> $request->inn,
            'balance'=> 0,
            'about'=> $request->about,
            'user_type'=> $request->user_type
        ];

        $user = User::create($data);
        return BaseController::response(true, 'successful', ['id'=>$user->id]);
    }

    public function index(Request $request){
        require_once 'lib.php';
        $search = $request->search;
        $limit = $request->limit ?? 50;
        $cyr = str_replace($latinToCyr['latin'], $latinToCyr['cyr'], $search);
        $latin = str_replace($cyrToLatin['cyr'], $cyrToLatin['latin'], $search);
        $clients = User::select('id as client_id', 'full_name', 'phone', 'inn', 'balance', 'about', 'user_type', 'created_at')->orderBy('balance', 'asc')->where('full_name', 'like', "%{$cyr}%")
            ->orWhere('full_name', 'like', "%{$latin}%")
            ->orWhere('phone', 'like', "%{$search}%");

        $paginate = $clients->paginate($limit);
        $data = collect($paginate)['data'];
        $final = [];
        foreach ($data as $item) {
            $final[] = [
                'client_id'=> $item['client_id'],
                'full_name'=> $item['full_name'],
                'phone'=> $item['phone'],
                'inn'=> $item['inn'],
                'balance'=> $item['balance'] ?? 0,
                'about'=> $item['about'] ?? ' ',
                'user_type'=> $item['user_type'],
                'created_at'=> $item['created_at'],
            ];
        }
        return BaseController::response(true, 'successful', $data);
    }

    public function orders(Request $request, $client_id){
        $final = [];
        $client = User::find($client_id);
        $baskets = Basket::where('is_deleted', false)->where('client_id', $client_id)->get();
        foreach ($baskets as $basket) {
            $orders = Orders::select('orders.id as order_id', 'prodacts.id as product_id', 'prodacts.name as product_name',
                'prodacts.brand as product_brand', 'orders.count', 'orders.price')
                ->join('prodacts', 'prodacts.id', 'orders.product_id')
                ->where('orders.basket_id', $basket->id)
                ->get();
            $final[] = [
                'client_id'=> $client->id,
                'client_name'=> $client->full_name,
                'phone'=> $client->phone,
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

}
