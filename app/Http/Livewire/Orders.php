<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\usd;
use App\Models\Cash;
use App\Models\Basket;
use App\Models\Profit;
use App\Models\Prodact;
use Livewire\Component;
use App\Models\Warehouse;
use App\Models\Orders as  Order;

class Orders extends Component
{
    public $client;
    public $to;
    public $do;
    public $term;
    public $basket_id;
    public $show = \false;
    public $show_bakset = [];
    public $payment_type;
    public $defect_ids = [];
    public $returnes_ids = [];
    public $minus = [];
    public function basket($id){
        $this->show = true;
        $this->basket_id = $id;
        $this->show_bakset = Order::select('orders.id as order_id', 'prodacts.name as product_name', 'orders.count', 'orders.price')
            ->join('prodacts', 'prodacts.id', 'orders.product_id')
            ->where('orders.basket_id', $this->basket_id)->get();
        $this->returnes_ids = [];
        $this->defect_ids = [];
    }
    public function defect($id){
        if(!in_array($id, $this->defect_ids) and !in_array($id, $this->returnes_ids)){
            $this->defect_ids[] = $id;
        }elseif(in_array($id, $this->returnes_ids)){
            $index = array_search($id, $this->returnes_ids);
            unset($this->returnes_ids[$index]);
            $this->returnes_ids = array_values($this->returnes_ids);
            $this->defect_ids[] = $id;
        }
    }

    public function returnes($id){
        if(!in_array($id, $this->defect_ids) and !in_array($id, $this->returnes_ids)){
            $this->returnes_ids[] = $id;
        }elseif(in_array($id, $this->defect_ids)){
            $index = array_search($id, $this->defect_ids);
            unset($this->defect_ids[$index]);
            $this->defect_ids = array_values($this->defect_ids);
            $this->returnes_ids[] = $id;
        }

    }

    public function save(){
        $minus_price = 0;
        $basket = Basket::find($this->basket_id);
        $cash = $basket->cash;
        $card = $basket->card;
        $cost_price = 0;
        $usd = usd::find(1)->usd;
        $orders = Order::wherein('id', $this->returnes_ids)->get();
        foreach($orders as $order){
            $minus_count = $this->minus[$order->id];
            $count = $order->count;
            $price = $order->price;
            if($minus_count > $count){
                $this->error[] = $order->id;
            }else{
                $order->update([
                    'count'=> $count - $minus_count,
                ]);

                Warehouse::SetNow($order->product_id, $minus_count, true);
                $minus_price += $minus_count*$price;
                $cost_price += ($usd*$order->product->cost_price)*$minus_count;
            }
        }
        if($minus_price > 0){
            if($cash >= $minus_price){
                $cash -= $minus_price;
            }elseif($card >= $minus_price){
                $card -= $minus_price;
            }elseif($card+$cash >= $minus_price){
                $card -= $minus_price;
                $temp = abs($card);
                $card = 0;
                $cash -= $temp;
            }
            $cash_register = Cash::orderBy('id', 'desc')->first();
            $cash_register->update([
                'balance'=> $cash_register->balance-$minus_price,
            ]);
            $profit = Profit::orderBy('id', 'desc')->first();
            $profit->update([
                'balance'=> $profit->balance-$cost_price
            ]);
            $basket->update([
                'card'=> $card,
                'cash'=> $cash,
                'price'=> $basket->price - $minus_price
            ]);
            $this->show = false;
        }
        $this->basket_id = null;
        $this->returnes_ids = [];
        $this->minus = [];
        $this->show = false;
    }

    public function render()
    {
        $this->show_bakset = Order::select('orders.id as order_id', 'prodacts.name as product_name', 'orders.count', 'orders.price')
            ->join('prodacts', 'prodacts.id', 'orders.product_id')
            ->where('orders.basket_id', $this->basket_id)->get();
        $to = isset($this->to) ? date('Y-m-d', strtotime($this->to)):Carbon::today();
        $do = isset($this->do) ? date('Y-m-d', strtotime($this->do)):Carbon::today();

        $baskets = Basket::select('baskets.id as basket_id', 'users.full_name', 'users.phone', 'baskets.price', 'baskets.cash', 'baskets.debt', 'baskets.card', 'baskets.term', 'baskets.description', 'baskets.created_at')
            ->join('users', 'users.id', 'baskets.client_id')
            ->whereDate('baskets.created_at', '>=', $to)
            ->whereDate('baskets.created_at', '<=', $do);
        if(isset($this->term)){
            $baskets = $baskets->whereDate('baskets.term', date('Y-m-d', strtotime($this->term)));
        }
        if(isset($this->client)){
            $baskets = $baskets->where('users.full_name', 'like', "%{$this->client}%")->orWhere('users.phone', 'like', "%{$this->client}%");
        }
        if($this->payment_type and $this->payment_type != "all"){
            $baskets = $baskets->where($this->payment_type, '>', 0);
        }
        return view('livewire.orders',[
            'baskets'=> $baskets->get(),
        ]);
    }
}
