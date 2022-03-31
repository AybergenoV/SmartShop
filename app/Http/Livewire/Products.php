<?php

namespace App\Http\Livewire;

use App\Models\usd;
use App\Models\Prodact;
use Livewire\Component;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;

class Products extends Component
{
    use WithPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $product_id;
    public $delete;
    public $product = [];
    public $update = false;
    public $show = false;
    public $categories = [];
    public $category;
    public $photo;
    public $name;
    public $url;
    public $category_id;
    public $price;
    public $category_s_id;
    public $count;
    public $import = false;
    public $excel;

    protected $rules = [
        'product' => 'required',
        'product.price_min' => 'required',
        'product.price_max' => 'required',
        'product.price_wholesale' => 'required',
        'product.cost_price' => 'required',
        'product.brand' => 'required',
        'product.name' => 'required',
        'category_id' => 'required',
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function mount(){
        $this->categories = Category::all();
    }
    public function save(){
        $this->product['category_id'] = $this->category_id;
        if($this->update){
            Prodact::find($this->product_id)->update($this->product);
        }else{
            $this->validate();
            $product = Prodact::create($this->product);
            if(isset($this->count)){
                Warehouse::create([
                    'product_id'=> $product->id,
                    'new'=> $this->count,
                    'extant_was'=> 0,
                    'sold_out'=>0,
                    'remained'=>$this->count
                ]);
            }
            $this->count = null;
        }
        $this->show = \false;
        $this->product = [];
        $this->category_id = null;
    }
    public function delete($id){
        $this->delete = true;
        $this->product_id = $id;
    }

    public function deleteConfirm(){
        Prodact::find($this->product_id)->delete();
        $this->delete = false;
        $this->mount();
    }

    public function deleteClose(){
        $this->delete = false;
        $this->mount();
    }

    public function edit($id){
        $product = Prodact::find($id)->toArray();
        $this->product = $product;
        $this->price = $product['cost_price'];
        $this->category_id = $product['category_id'];
        $this->update = \true;
        $this->product_id = $id;
        $this->show = true;
    }
    public function close(){
        $this->rest();
        $this->product_id = null;
        $this->show = \false;
        $this->update = \false;
        $this->import = false;
    }
    public function show(){
        $this->rest();
        $this->show = true;
    }
    public function rest(){
        $this->delete = false;
        $this->product = [];
        $this->category_id = null;
        $this->update = \false;
    }
    public function render(){

        if(isset($this->category_id) and isset($this->product['cost_price']) and $this->price != $this->product['cost_price']){
            $category = Category::find($this->category_id);
            $price = (double) $this->product['cost_price'];
            $usd = usd::find(1)->usd;
            $sum = $price < 1 ? 100:500;
            $div = $price < 1 ? 100:1000;
            $this->product['price_wholesale'] = $price*$category->percent_wholesale/100+$price;
            $this->product['price_max'] = floor(((($price*$category->percent_max/100+$price)*$usd+$sum)/$div))*$div;
            $this->product['price_min'] = floor(((($price*$category->percent_min/100+$price)*$usd+$sum)/$div))*$div;
        }
        $products = Prodact::select(
            'prodacts.id as product_id',
            'categories.id as category_id',
            'categories.name as category_name',
            'categories.min_count as min_count',
            'categories.percent_wholesale',
            'categories.percent_min',
            'categories.percent_max',
            'prodacts.name as product_name',
            'prodacts.brand as product_brand',
            'prodacts.image as product_image',
            'prodacts.cost_price as product_cost_price',
            'prodacts.price_wholesale', 'prodacts.price_max', 'prodacts.price_min')
            ->join('categories', 'categories.id', 'prodacts.category_id')->where('prodacts.name', 'like', "%{$this->name}%");
            if(isset($this->category_s_id) and $this->category_s_id != "all"){
                $products = $products->where('prodacts.category_id', $this->category_s_id);
            }
        return view('livewire.products',[
            'products'=> $products->paginate(55)
        ]);
    }

    public function example(){
        return response()->download(public_path('storage/products.xlsx'));
    }
    public function export(){
        return Excel::download(new ProductExport, 'products.xlsx');
    }
    public function import(Request $request){
        $this->import = true;
    }
}
