<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use App\Models\Category;
use App\Models\Prodact;
use App\Models\usd as ModelsUsd;
use Livewire\Component;

class Usd extends Component
{
    public $usd;
    public $balance;

    public function mount(){
        $this->usd = ModelsUsd::find(1)->usd ?? 0;
        $this->usd = ModelsUsd::find(1)->usd ?? 0;
        $this->balance = Cash::now();
    }

    public function close(){
        $this->usd = null;
    }
    public function refresh(){
        $this->mount();
    }

    public function save(){
        $products = Prodact::all();
        $usd = ModelsUsd::find(1);
        if($usd->usd != $this->usd){
            if($usd){
                $usd->update([
                    'usd'=> $this->usd,
                ]);
            }else{
                ModelsUsd::create([
                    'usd'=> $this->usd,
                ]);
            }
            foreach ($products as $product) {
                $category = Category::find($product->category_id);
                $percent_wholesale = $category->percent_wholesale;
                $percent_min = $category->percent_min;
                $percent_max = $category->percent_max;
                $price = $product->cost_price;

                $product->update([
                    'price_wholesale'=>  $price*$percent_wholesale/100+$price,
                    'price_min'=>  floor(((($price*$percent_min/100+$price)*$this->usd+500)/1000))*1000,
                    'price_max'=>  floor(((($price*$percent_max/100+$price)*$this->usd+500)/1000))*1000
                ]);
            }
        }

    }
    public function render()
    {
        return view('livewire.usd');
    }
}
