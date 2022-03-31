<?php

namespace App\Http\Livewire;

use App\Models\Cash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Consumption_category;
use App\Models\Consumption as ModelsConsumption;
use Carbon\Carbon;

class Consumption extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $show = false;
    public $consumption = [];
    public $category;
    public $to;
    public $do;
    public $category_id;
    public $type;


    protected $rules = [
        'consumption.price' => 'required',
        'consumption.staff' => 'required',
        'consumption.category_id' => 'required',
        'consumption.description' => 'required',
        'consumption.date' => 'required'
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount($type){
        $this->type = $type;
        $this->category = Consumption_category::all();
    }

    public function show(){
        $this->show = true;
    }
    public function close(){
        $this->show = false;
    }

    public function save(){
        $this->validate();
        $balance = Cash::now();
        $this->consumption['type'] = $this->type;
        if($this->type == "income"){
            Cash::orderBy('id', 'desc')->first()->update([
                'balance'=> $balance+$this->consumption['price']
            ]);
        }else{
            Cash::orderBy('id', 'desc')->first()->update([
                'balance'=> $balance-$this->consumption['price']
            ]);
        }
        ModelsConsumption::create($this->consumption);
        $this->show = \false;
    }

    public function render(){
        $to = $this->to ?? Carbon::today();
        $do = $this->do ?? Carbon::today();

        $consumptions = ModelsConsumption::select('consumption_categories.name as category_name', 'consumptions.date', 'consumptions.price', 'consumptions.description', 'consumptions.staff')
            ->join('consumption_categories', 'consumption_categories.id', 'consumptions.category_id')
            ->where('consumptions.type', $this->type)
            ->whereDate('consumptions.date', '>=', $to)
            ->whereDate('consumptions.date', '<=', $do);
        if(isset($this->category_id)){
            $consumptions = $consumptions->where('consumptions.category_id', $this->category_id);
        }
        return view('livewire.consumption', [
            'consumptions'=> $consumptions->paginate(55),
        ]);
    }
}
