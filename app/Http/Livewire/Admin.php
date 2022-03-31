<?php

namespace App\Http\Livewire;

use App\Models\Admin as ModelsAdmin;
use App\Models\Salary;
use Carbon\Carbon;
use Livewire\Component;

class Admin extends Component
{
    public $update = false;
    public $show = false;
    public $show_salary = false;
    public $name;
    public $pincode;
    public $admin_id;
    public $pincodemd;
    public $salary;
    public $flex;
    public $user = [
        'role'=> 'seller',
    ];
    public $salary_history = [];
    public $salary_history_show = false;
    public $to;
    public $do;
    public function save_salary(){
        $admin = ModelsAdmin::all();
        foreach ($admin as $item) {
            $item->update([
                'salary'=> $this->salary,
                'flex'=> $this->flex
            ]);
        }
        $this->salary = \null;
        $this->flex = null;
        $this->show_salary = \false;
    }

    protected $rules = [
        'user.name' => 'required',
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->pincode();
        $year = date('Y')-1;
        $month = 1;
        $this->to = $this->to ?? Carbon::create($year, $month)->startOfMonth('Y-m-d')->format('Y-m-d');
        $this->do = $this->do ?? Carbon::today()->format('Y-m-d');
    }

    public function show(){
        $this->show = \true;
    }

    public function close(){
        $this->user = [
            'role'=> 'seller',
        ];
        $this->admin_id = null;
        $this->update = \false;
        $this->show = \false;
    }
    public function show_salary(){
        $this->show_salary = \true;
    }

    public function close_salary(){
        $this->show_salary = \false;
        $this->salary_history_show = false;
        $this->salary_history = [];
        $this->name ='';
    }

    public function edit($id){
        $this->pincode();
        $this->update = true;
        $this->show();
        $this->user = ModelsAdmin::find($id)->toArray();
        $this->admin_id = $id;
    }

    public function create(){
        if($this->update){
            $this->user['pincode'] = md5($this->pincode);
            ModelsAdmin::find($this->admin_id)->update($this->user);
        }else{
            $this->validate();
            $this->user['pincode'] = md5($this->pincode);
            ModelsAdmin::create($this->user);
        }
        $this->user = [
            'role'=> 'seller',
        ];
        $this->close();
    }

    public function pincode(){
        $active = \true;
        while($active){
            $pincode = rand(1000, 9999);
            $pincodes = \array_column(ModelsAdmin::all('pincode')->toArray(), 'pincode');
            if(!in_array(md5($pincode), $pincodes)){
                $this->pincode = $pincode;
                $active = false;
            }
        }
    }
    public function salary($id,$name){
        $this->salary_history = Salary::where('admin_id', $id)
            ->whereDate('created_at', '>=', $this->to)
            ->whereDate('created_at', '<=', $this->do)->get();
        $this->name = $name;
        $this->salary_history_show = true;
    }
    public function render()
    {
        return view('livewire.admin',[
            'admins'=> ModelsAdmin::all()
        ]);
    }
}
