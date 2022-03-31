<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        $categories = Category::select('id as category_id', 'name', 'min_count', 'percent_wholesale', 'percent_min', 'percent_max');
        if(isset($search)){
            $categories->where('name', 'like', "%{$search}%");
        }
        return BaseController::response(true, 'successful', $categories->get()->toArray());
    }

    public function create(Request $request){
        $name = $request->name;
        $percents = $request->percents;
        
        $validation = Validator::make($request->all(), [
            'name'=> 'required|max:255|unique:App\Models\Category,name',
            'min_count'=> 'required|integer',
            'percents.wholesale'=> 'required|integer',
            'percents.max'=> 'required|integer',
            'percents.min'=> 'required|integer',
        ]);

        if($validation->fails()){
            $errors = BaseController::response(false, $validation->errors()->first(), [], 422);
            return $errors;
        }

        $category = Category::create([
            'name'=>$name,
            'percent_wholesale'=>$percents['wholesale'],
            'percent_min'=>$percents['min'],
            'percent_max'=>$percents['max'],
            'min_count'=>$request->min_count
        ]);

        return BaseController::response(true, 'successful', ['id'=>$category->id]);
    }

    public function update($id, Request $request){
        $name = $request->name;
        $percents = $request->percents;
        $data = [];
        if(isset($name)){
            $data['name'] = $name;
        }
        if(isset($percents['wholesale'])){
            $data['percent_wholesale'] = $percents['wholesale'];
        }
        if(isset($percents['min'])){
            $data['percent_min'] = $percents['min'];
        }
        if(isset($percents['max'])){
            $data['percent_max'] = $percents['max'];
        }
        Category::find($id)->update($data);
        return BaseController::response(true, 'successful');
    }
}
