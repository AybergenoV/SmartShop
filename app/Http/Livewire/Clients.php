<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Clients extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name = null;
    public $type = 1;
    public $show = \false;
    public $user = [
        'phone'=> '+998'
    ];
    protected $rules = [
        'type' => 'required',
        'user.phone' => 'required|unique:users,phone|min:13|max:13',
        'user.full_name' => 'required',
        'user.inn' => 'required_unless:type,0'
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function close(){
        $this->show = false;
    }

    public function show(){
        $this->show = true;
    }

    public function save(){
        $this->validate();
        $this->user['phone'] = substr($this->user['phone'], 4);
        User::create([
            'full_name'=> $this->user['full_name'],
            'phone'=> $this->user['phone'],
            'inn'=> $this->user['inn'] ?? null,
            'about'=> $this->user['about'] ?? null,
            'type'=> $this->type
        ]);
        $this->user = [
            'phone'=> '+998'
        ];
        $this->show = \false;
    }

    public function render()
    {
        $users = User::orderBy('balance', 'asc')->where('full_name', 'like', "%{$this->name}%")->orWhere('phone', 'like', "%{$this->name}%");
        return view('livewire.clients',[
            'users'=>$users->paginate(50),
        ]);
    }
}
