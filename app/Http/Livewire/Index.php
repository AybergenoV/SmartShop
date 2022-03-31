<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Orders;
use Livewire\Component;

class Index extends Component
{
    public $staffs;
    public $staff_id;
    public $to;
    public $do;

    public function mount(){
        $this->staffs = Admin::all();
    }

    public function render()
    {
        $start = new Carbon('first day of this month');
        $this->to = $this->to ?? $start->format("Y-m-d");
        $this->do = $this->do ?? Carbon::today()->format('Y-m-d');
        $staff_id = $this->staff_id;
        $products = Orders::select('orders.product_id', 'prodacts.name as product_name', 'prodacts.image as image', 'orders.count')
        ->join('prodacts', 'prodacts.id', 'orders.product_id')
        ->join('baskets', 'baskets.id', 'orders.basket_id')
        ->whereDate('baskets.updated_at', '>=', $this->to)
        ->whereDate('baskets.updated_at', '<=', $this->do);

        if($staff_id and $staff_id != 'all'){
            $products = $products->where('baskets.admin_id', $staff_id);
        }
        $products = $products->get();
        $collect = collect($products)->groupBy('product_id');
        $final =[];
        $groupwithcount = $collect->mapWithKeys(function ($group, $key) {
            return [
                $key =>[
                    'product_id'=> $key,
                    'product_image'=>$group->first()['image'],
                    'product_name'=>$group->first()['product_name'],
                    'count' => $group->sum('count')
                ]
            ];
        })->toArray();


        return view('livewire.index', ['products'=> array_values($groupwithcount)]);
    }
}
