<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'date',
        'price',
        'description',
        'staff',
        'type'
    ];
}
