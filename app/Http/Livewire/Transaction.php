<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction as ModelTransaction;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $transaction = ModelTransaction::orderBy('id', 'desc')->where('title', 'Payment')->paginate(50);
        return view('livewire.transaction',[
            'transaction'=> $transaction
        ]);
    }
}
