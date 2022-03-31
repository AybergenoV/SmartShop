<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance'
    ];

    public function ScopeNow($query, $to = null, $do = null){
        if($to === null){
            $to = date('Y-m-d');
        }
        if($do === null){
            $do = date('Y-m-d');
        }
        return $query->whereDate('created_at', '>=', $to)
            ->whereDate('created_at', '<=', $do)
            ->sum('balance');
    }
}
