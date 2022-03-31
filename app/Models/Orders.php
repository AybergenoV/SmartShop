<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'basket_id',
        'product_id',
        'count',
        'price',
    ];

    public function product(){
        return $this->belongsTo(Prodact::class);
    }
}
