<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'new', 'extant_was', 'sold_out', 'remained'
    ];

    public function scopeSetNow($query, $product_id, $count, $plus = true){
        $data = $query->orderBy('id', 'desc')->where('product_id', $product_id)->first();
        if($data){
            $data->update([
                'remained'=> $plus == true ? $data->remained + $count:$data->remained - $count,
            ]);
        }else{
            $data = $query->create([
                'product_id'=> $product_id,
                'extant_was'=> 0,
                'new'=> $count,
                'sold_out'=> 0,
                'remained'=> $count
            ]);
        }
        return $data;
    }

}
