<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;
    protected $fillable = ['balance'];

    public static function now($to = null, $do = null){
        if($to === null){
            $to = date('Y-m-d');
        }
        if($do === null){
            $do = date('Y-m-d');
        }
        $new = new static;
        return $new->newQuery()
            ->whereDate('created_at', '>=', $to)
            ->whereDate('created_at', '<=', $do)
            ->sum('balance');
    }
}
