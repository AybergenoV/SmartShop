<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Prodact;
use App\Models\Warehouse;
use Livewire\Component;
use App\Models\usd;

class Categories extends Component
{
    public $categoris;
    public $show = false;
    public $update = false;
    public $category;
    public $max;
    public $min;
    public $optom;
    public $min_count;
    public $category_id;
    public $delete;
    public $conf;

    protected $rules = [
        'category' => 'required',
        'optom' => 'required',
        'max' => 'required',
        'min' => 'required',
        'min_count' => 'required'
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->categoris = Category::all();
    }

    public function show(){
        $this->rest();
        $this->show = true;
    }
    public function close(){
        $this->rest();
        $this->show = false;
    }

    public function create(){
        if($this->update){
            Category::find($this->category_id)->update([
                'name'=> $this->category,
                'percent_wholesale'=> $this->optom,
                'percent_min'=> $this->min,
                'percent_max'=> $this->max,
                'min_count'=> $this->min_count
            ]);
            $products = Prodact::where('category_id', $this->category_id)->get();
            foreach ($products as $product) {
                $price = $product->cost_price;
                $usd = usd::find(1)->usd;
                $product->update([
                    'price_min'=>floor(((($price*$this->min/100+$price)*$usd+500)/1000))*1000,
                    'price_max'=>floor(((($price*$this->max/100+$price)*$usd+500)/1000))*1000,
                    'price_wholesale'=>$price*$this->optom/100+$price
                ]);
            }
        }else{
            $this->validate();
            Category::create([
                'name'=> $this->category,
                'percent_wholesale'=> $this->optom,
                'percent_min'=> $this->min,
                'percent_max'=> $this->max,
                'min_count'=> $this->min_count
            ]);
        }
        $this->rest();
        $this->mount();
    }

    public function edit($id){
        $category = Category::find($id);
        $this->category = $category->name;
        $this->optom = $category->percent_wholesale;
        $this->max = $category->percent_max;
        $this->min = $category->percent_min;
        $this->min_count = $category->min_count;
        $this->update = true;
        $this->category_id = $id;
        $this->show = true;
    }

    public function delete($id){
        $this->delete = true;
        $this->category_id = $id;
    }

    public function deleteConfirm(){
        if($this->conf){
            Category::find($this->category_id)->delete();
            $this->categoris = Category::all();
            $products = Prodact::where('category_id', $this->category_id)->get();
            foreach ($products as $item) {
                Warehouse::where('product_id', $item->id)->delete();
            }
            Prodact::where('category_id', $this->category_id)->delete();
            $this->rest();
        }
    }

    public function deleteClose(){
        $this->delete = false;
        $this->rest();
    }

    private function rest(){
        $this->update = false;
        $this->category_id = null;
        $this->category = null;
        $this->show = false;
        $this->min = null;
        $this->max = null;
        $this->optom = null;
        $this->min_count = null;
        $this->delete = false;
    }

    public function render()
    {
        return view('livewire.categories');
    }
}
