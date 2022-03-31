<?php

namespace App\Http\Livewire;

use App\Models\usd;
use App\Models\Prodact;
use Livewire\Component;
use App\Models\Category;
use App\Models\Warehouse;

class WarehouseAdd extends Component
{
    public $name;
    public $transactions = [];
    public $category;
    public $min;
    public $max;
    public $btn_id = "";
    public $show;
    public $categories;
    public $product = [];
    public $category_id;
    public $price;
    public $count;
    
    public function show(){
        $this->show = true;
    }
    public function close(){
        $this->product = [];
        $this->show = \false;
    }
    public function mount(){
        $this->categories = Category::all();
    }
    public function saveProduct(){
        $this->product['category_id'] = $this->category_id;
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
        $this->show = \false;
        $this->product = [];
        $this->category_id = null;
    }
    public function save(){
        $i = 0;
        $products = array_keys($this->transactions);
        $counts = array_values($this->transactions);

        if(array_sum($counts) > 0){
            foreach ($counts as $count) {
                if($count > 0){
                    $warehouse = Warehouse::orderBy('id', 'desc')->where('product_id', $products[$i])->first();
                    $remained = $warehouse->remained ?? 0;
                    Warehouse::create([
                        'product_id'=> $products[$i],
                        'new'=> $counts[$i],
                        'extant_was'=> $remained,
                        'sold_out'=>0,
                        'remained'=>$remained+$counts[$i]
                    ]);
                }
                $i++;
            }
            $this->transactions = [];
        }

    }
    private function set(){
        if(isset($this->category_id) and isset($this->product['cost_price']) and $this->price != $this->product['cost_price']){
            $category_this = Category::find($this->category_id);
            $price = (double) $this->product['cost_price'];
            $usd = usd::find(1)->usd;
            $sum = $price < 1 ? 100:500;
            $div = $price < 1 ? 100:1000;
            $this->product['price_wholesale'] = $price*$category_this->percent_wholesale/100+$price;
            $this->product['price_max'] = floor(((($price*$category_this->percent_max/100+$price)*$usd+$sum)/$div))*$div;
            $this->product['price_min'] = floor(((($price*$category_this->percent_min/100+$price)*$usd+$sum)/$div))*$div;
        }
    }
    public function render()
    {
        $this->set();
        $counts = array_sum(array_values($this->transactions));
        if($counts > 0){
            $this->btn_id = "kt_docs_sweetalert_basic";
        }else{
            $this->btn_id = "kt_docs_sweetalert_state_error";
        }
        $products = Warehouse::select('warehouses.id as warehouse_id', 'prodacts.id', 'prodacts.name', 'prodacts.image', 'warehouses.remained', 'prodacts.brand')
            ->rightJoin('prodacts', 'warehouses.product_id', 'prodacts.id');
        if(isset($this->name)){
            $products->where('prodacts.name', 'like', "%{$this->name}%");
        }
        if(isset($this->category) and $this->category != 'all'){
            $products->where('prodacts.category_id', $this->category);
        }
    
        $unique = \collect($products->orderBy('warehouse_id', 'desc')->get())->unique('id');
        if(isset($this->max)){
            $unique = $unique->where('remained', '>=', $this->max);
        }
        if(isset($this->min)){
            $unique = $unique->where('remained', '<=', $this->min);
        }

        return view('livewire.warehouse-add',[
            'products'=>$unique->toArray()
        ]);
    }
}
