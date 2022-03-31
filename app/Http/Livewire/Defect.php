<?php

namespace App\Http\Livewire;

use App\Models\Prodact;
use Livewire\Component;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Warehouse;
use App\Models\WarehouseBasket;
use App\Models\WarehouseOrder;
use Illuminate\Http\Request;

class Defect extends Component
{
    public $name;
    public $transactions = [];
    public $category;
    public $min;
    public $max;
    public $btn_id = "";
    public $show;
    public $categories;
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
    public function save(Request $request){
        $user = $request->user();
        $i = 0;
        $products = array_keys($this->transactions);
        $counts = array_values($this->transactions);

        if(array_sum($counts) > 0){
            $basket = WarehouseBasket::create([
                'user_id'=> $user->id
            ]);
            foreach ($counts as $count) {
                if($count > 0){
                    $warehouse = Warehouse::orderBy('id', 'desc')->where('product_id', $products[$i])->first();
                    $remained = $warehouse->remained ?? 0;
                    WarehouseOrder::create([
                        'warehouse_basket_id'=> $basket->id,
                        'product_id'=> $products[$i],
                        'count'=> $counts[$i]
                    ]);
                    $warehouse->update([
                        'remained'=> $remained-$counts[$i]
                    ]);
                }
                $i++;
            }
            Transaction::create([
                'title'=> 'Бракованный',
                'basket_id'=> $basket->id,
                'from_id'=> $user->id
            ]);
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

        $unique = \collect($products->orderBy('warehouse_id', 'desc')->get())->unique('id')->where('remained', '>', 0);
        if(isset($this->max)){
            $unique = $unique->where('remained', '>=', $this->max);
        }
        if(isset($this->min)){
            $unique = $unique->where('remained', '<=', $this->min);
        }
        return view('livewire.defect', [
            'products'=>$unique->toArray()
        ]);
    }
}
