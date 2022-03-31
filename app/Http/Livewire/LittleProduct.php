<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Warehouse;

class LittleProduct extends Component
{
    public $name;
    public $transactions = [];
    public $category;
    public $min;
    public $max;
    public $btn_id = "";

    public function mount(){
        $this->categories = Category::all();
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

    public function render()
    {
        $final = [];
        $counts = array_sum(array_values($this->transactions));
        if($counts > 0){
            $this->btn_id = "kt_docs_sweetalert_basic";
        }else{
            $this->btn_id = "kt_docs_sweetalert_state_error";
        }
        $products = Warehouse::select('categories.name as category_name',  'categories.min_count', 'warehouses.id as warehouse_id', 'prodacts.id', 'prodacts.name', 'prodacts.image', 'warehouses.remained', 'prodacts.brand')
            ->rightJoin('prodacts', 'warehouses.product_id', 'prodacts.id')
            ->join('categories', 'categories.id', 'prodacts.category_id');
            
        if(isset($this->name)){
            $products->where('prodacts.name', 'like', "%{$this->name}%");
        }
        if(isset($this->category) and $this->category != 'all'){
            $products->where('prodacts.category_id', $this->category);
        }
        
        $unique = collect($products->orderBy('warehouse_id', 'desc')->get())->unique('id');
        if(isset($this->max)){
            $unique = $unique->where('remained', '>=', $this->max);
        }
        if(isset($this->min)){
            $unique = $unique->where('remained', '<=', $this->min);
        }
        foreach ($unique->toArray() as $item) {
            if($item['min_count'] >= $item['remained']){
                $final[] = $item;
            }
        }
        return view('livewire.little-product',[
            'products'=>$final
        ]);
    }
}
