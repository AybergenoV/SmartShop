<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'percent', 'percent_max', 'percent_min', 'min_count', 'percent_wholesale'
    ];
}
