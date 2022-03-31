<?php

namespace App\Http\Controllers\api;

use App\Models\Warehouse;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\WarehouseOrder;
use App\Models\WarehouseBasket;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class DefectController extends Controller
{
    public function defect(Request $request){
        $defects = $request->defect_products;
        $product_ids = array_column($defects, 'product_id');
        $products = Warehouse::OrderBy('id', 'desc')->whereIn('product_id', $product_ids)->get(['id', 'product_id', 'remained'])->unique('product_id')->values()->toArray();
        if(count($defects) != count($products)){
            return BaseController::response(false, 'tovar jetpeydi.');
        }
        foreach ($defects as $defect) {
            $product_id = $defect['product_id'];
            $count = $defect['count'];
            $index = array_search($defect['product_id'], array_column($products, 'product_id'));
            if($products[$index]['remained'] < $count){
                return BaseController::response(false, 'tovar jetpeydi');
            }
        }
        $user = $request->user();
        $basket = WarehouseBasket::create([
            'user_id'=> $user->id
        ]);
        foreach ($defects as $defect) {
            $product_id = $defect['product_id'];
            $count = $defect['count'];
            $index = array_search($defect['product_id'], array_column($products, 'product_id'));
            WarehouseOrder::create([
                'warehouse_basket_id'=> $basket->id,
                'product_id'=> $product_id,
                'count'=> $count
            ]);
            Warehouse::find($products[$index]['id'])->update([
                'remained'=> $products[$index]['remained']-$count
            ]);
        }
        Transaction::create([
            'title'=> 'Бракованный',
            'basket_id'=> $basket->id,
            'from_id'=> $user->id
        ]);
        return BaseController::response(true, 'successful');
    }
}
