<?php

namespace App\Http\Controllers\api;

use App\Models\Prodact;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\WarehouseOrder;
use App\Models\WarehouseBasket;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $filter = $request->filter;
        $warehouse = Warehouse::select('warehouses.id', 'prodacts.id as product_id', 'prodacts.name', 'prodacts.image', 'prodacts.cost_price', 'prodacts.brand', 'cost_price', 'prodacts.category_id',
        'warehouses.extant_was', 'warehouses.new', 'warehouses.sold_out', 'warehouses.remained')
        ->rightJoin('prodacts', 'prodacts.id', 'warehouses.product_id')
        ->orderBy('warehouses.id', 'desc')
        ->where('prodacts.name', 'like', "%{$search}%")->get();

        $unique = array_values(collect(collect($warehouse))->unique('product_id')->toArray());
        $data = ['products'=>[], 'ids'=>[]];
        $products = array_column(Prodact::all()->toArray(), 'id');
        foreach ($unique as $item) {
            $data['products'][] = [
                'category'=> Category::select('id', 'name', 'min_count')->where('id', $item['category_id'])->first(),
                'product_id'=> $item['product_id'],
                'product_name'=> $item['name'],
                'product_brand'=>$item['brand'],
                'remained'=> (int) $item['remained']
            ];
        }
        return BaseController::response(true, 'successful', $data['products']);
    }

    public function create(Request $request){
        $user = $request->user();
        $validation = Validator::make($request->all(), [
            'transactions'=> 'required',
            'transactions.*.product_id'=> 'required|exists:App\Models\Prodact,id',
            'transactions.*.new'=>'required'
        ]);

        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }
        $basket = WarehouseBasket::create([
            'user_id'=> $user->id
        ]);
        foreach ($request->transactions as $transaction) {
            $warehouse = Warehouse::orderBy('id', 'desc')
                ->where('product_id', $transaction['product_id'])->first();
            $remained = $warehouse->remained ?? 0;
            Warehouse::create([
                'product_id'=> $transaction['product_id'],
                'new'=> $transaction['new'],
                'extant_was'=> $remained,
                'sold_out'=>0,
                'remained'=>$remained+$transaction['new']
            ]);
            WarehouseOrder::create([
                'warehouse_basket_id'=> $basket->id,
                'product_id'=> $transaction['product_id'],
                'count'=> $transaction['new']
            ]);
        }
        Transaction::create([
            'title'=> 'На склад',
            'basket_id'=> $basket->id,
            'from_id'=> $user->id
        ]);
        return BaseController::response(true, 'successful');
    }
}
