<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'basket_id',
        'product_id',
        'count',
        'price',
        'from_whom',
        'from_id',
        'to_whom',
        'to_id',
        'card',
        'cash',
        'debt',
    ];

    protected $casts = [
        'created_at'=>'datetime:Y-m-d H:i:s',
    ];
}
