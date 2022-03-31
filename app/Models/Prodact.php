<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'name', 'brand', 'cost_price', 'image','price_min', 'price_max', 'price_wholesale'
    ];
}
