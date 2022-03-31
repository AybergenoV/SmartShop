<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Prodact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ProductImport implements ToModel, WithCalculatedFormulas, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = $row;
        if($data['category'] === null){
            return;
        }
        $category = Category::where('name', $data['category'])->first();
        if(!$category){
            $category = Category::create([
                'name'=> $data['category'],
                'percent_wholesale'=>4,
                'percent_min'=> 5,
                'percent_max'=> 15,
                'min_count'=> 3
            ]);
        }
        $products = Prodact::where('name', $data['name'])->first();
        if(!$products){
            return new Prodact([
                'category_id'=>$category->id,
                'name'=> $data['name'],
                'brand'=>$data['brand'],
                'cost_price'=> $data['cost_price'],
                'image'=> "product.png",
                'price_wholesale'=> $data['price_wholesale'],
                'price_max'=> $data['price_max'],
                'price_min'=> $data['price_min']
            ]);
        }
    }
}
