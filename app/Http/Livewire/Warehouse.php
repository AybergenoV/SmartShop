<?php

namespace App\Http\Livewire;

use App\Models\Prodact;
use Livewire\Component;
use App\Models\Category;
use App\Models\Warehouse as ModelsWarehouse;

class Warehouse extends Component
{
    public $show;
    public $products;
    public $transactions;
    public $categories;
    public $category_id;
    public $product_name;

    public function mount(){
        $this->categories = Category::all();
        $this->products = Prodact::all();
    }

    public function show(){
        $this->show = !$this->show;
    }

    public function render()
    {
        $warehouse = ModelsWarehouse::orderBy('id', 'desc')->get();
        $unique = \collect($warehouse)->unique('product_id')->toArray();
        $data = ['products'=>[], 'ids'=>[]];
        foreach ($unique as $item) {
            $product = Prodact::where('id', $item['product_id']);
            if($this->category_id and $this->category_id != 'all'){
                $product = $product->where('category_id', $this->category_id);
            }
            $product = $product->first();
            if($product){
                $data['products'][] = [
                    'category'=> Category::where('id', $product->category_id)->select('id', 'name', 'min_count', 'percent_wholesale', 'percent_min', 'percent_max')->first()->toArray(),
                    'product_id'=> $item['product_id'],
                    'product_name'=> $product->name,
                    'product_image'=> $product->image,
                    'product_brand'=>$product->brand,
                    'product_cost_price'=>$product->cost_price,
                    'extant_was'=> $item['extant_was'],
                    'new'=> $item['new'],
                    'sold_out'=> $item['sold_out'],
                    'remained'=> $item['remained']
                ];
            }
            $data['ids'][] = $item['product_id'];
        }
        $products = Prodact::where('id', $item['product_id']);
        if($this->category_id and $this->category_id != 'all'){
            $products = $products->where('category_id', $this->category_id);
        }
        $products = $products->get();
        if(\count($data['products']) != \count($products)){
            foreach ($products as $product) {
                if(!in_array($product->id, $data['ids'])){
                    $final['products'][] = [
                        'category'=> Category::find($product->category_id)->select('id', 'name', 'percent_wholesale', 'percent_min', 'percent_max')->first()->toArray(),
                        'product_id'=> $product->id,
                        'product_name'=> $product->name,
                        'product_image'=> $product->image,
                        'product_brand'=>$product->brand,
                        'extant_was'=> 0,
                        'new'=> 0,
                        'sold_out'=> 0,
                        'remained'=> 0
                    ];
                }
            }
        }
        // array_search()
        return view('livewire.warehouse',[
            'warehouse'=>$data['products']
        ]);
    }
}
