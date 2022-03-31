<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'card',
        'cash',
        'debt',
        'price',
        'term',
        'description',
        'admin_id'
    ];
    protected $casts = [
        'is_deleted'=>'boolean',
        'created_at'=>'datetime: Y-m-d H:i:s',
        'updated_at'=>'datetime: Y-m-d H:i:s',
    ];
}
