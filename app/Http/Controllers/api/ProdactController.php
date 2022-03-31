<?php

namespace App\Http\Controllers\api;

use App\Exports\ProductExport;
use App\Models\Prodact;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;


class ProdactController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $category = $request->category;
        $limit = $request->limit ?? 50;
        $page = $request->page ?? 1;
        $prodacts = Prodact::select(
            'warehouses.id',
            'prodacts.id as product_id',
            'categories.id as category_id',
            'prodacts.name as product_name',
            'prodacts.brand as product_brand',
            'prodacts.image as product_image',
            'prodacts.cost_price as product_cost_price',
            'prodacts.price_wholesale', 'prodacts.price_max', 'prodacts.price_min', 'warehouses.remained')
            ->join('categories', 'categories.id', 'prodacts.category_id')
            ->join('warehouses', 'warehouses.product_id', 'prodacts.id')
            ->orderBy('warehouses.id', 'desc');

        if(isset($search)){
            $prodacts->where('prodacts.name', 'like', "%{$search}%");
        }
        if(isset($category)){
            $prodacts->where('prodacts.category_id', $category);
        }
        $paginate = $prodacts->paginate($limit);
        $data = array_values(collect(collect($paginate)['data'])->unique('product_id')->where('remained', '>', 0)->toArray());
        $new = ['current_page'=> (int)$page, 'last_page'=>$paginate->lastPage(), 'products'=>$data];
        return BaseController::response(true, 'successful', $new);
    }

    public function create(Request $request){
        $validation = Validator::make($request->all(), [
            'category_id'=> 'required|exists:App\Models\Category,id',
            'name'=>'required',
            'brand'=>'nullable',
            'cost_price'=>'required',
            'price_wholesale'=>'required',
            'price_max'=>'required',
            'price_min'=>'required',
            'new_count'=> 'required'
        ]);

        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }

        $data = [
            'category_id'=> $request->category_id,
            'name'=> $request->name,
            'brand'=> $request->brand,
            'cost_price'=> $request->cost_price,
            'price_min'=>$request->price_min,
            'price_max'=> $request->price_max,
            'price_wholesale'=> $request->price_wholesale
        ];
        $prodact = Prodact::create($data);
        Warehouse::create([
            'product_id'=> $prodact->id,
            'new'=> $request->new_count,
            'extant_was'=> 0,
            'sold_out'=>0,
            'remained'=>$request->new_count
        ]);
        return BaseController::response(\true, 'successful', ['id'=>$prodact->id]);
    }

    public function update($id, Request $request){
        $validation = Validator::make($request->all(), [
            'category_id'=> 'nullable|exists:App\Models\Category,id',
            'name'=>'nullable',
            'brand'=>'nullable',
            'cost_price'=>'nullable',
            'image'=>'nullable'
        ]);

        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }
        Prodact::find($id)->update($request->only('category_id', 'name', 'brand','cost_price', 'image'));
        return BaseController::response(true, 'successful');
    }

    public function import(Request $request){
        $file = $request->file('file');
        Excel::import(new ProductImport, $file);
        return back();
    }

    public function export(Request $request){
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
