<?php

namespace App\Http\Livewire;

use App\Models\Prodact;
use Livewire\Component;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\Transaction;

class MinusWarehouse extends Component
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
                    $setCount = $count > $remained ? $remained:$count;
                    $warehouse->update([
                        'remained'=>$remained-$setCount
                    ]);
                    Transaction::create([
                        'title'=>'minus',
                        'from_whom'=>'sklad',
                        'from_id'=> 0,
                        'to_whom'=> 'minus',
                        'to_id'=>0,
                        'product_id'=> $products[$i],
                        'count'=> $count
                    ]);
                }
                $i++;
            }
            $this->transactions = [];
        }

    }

    public function render()
    {
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
        return view('livewire.minus-warehouse',[
            'products'=>$unique->where('remained', '>', 0)->toArray()
        ]);
    }
}
