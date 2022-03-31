<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\WarehouseOrder;
use Livewire\Component;

class DefectShow extends Component
{
    public $basket_orders = [];
    public $show = false;

    public function close(){
        $this->show = false;
        $this->basket_orders = [];
    }

    public function bakset($id){
        $this->basket_orders = WarehouseOrder::select('prodacts.name', 'warehouse_orders.count')
            ->join('prodacts', 'prodacts.id', 'warehouse_orders.product_id')
            ->where('warehouse_basket_id', $id)->get();
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.defect-show',[
            'products'=> Transaction::where('title', 'Бракованный')->get(),
        ]);
    }
}
