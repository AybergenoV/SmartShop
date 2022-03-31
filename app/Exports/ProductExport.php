<?php

namespace App\Exports;

use App\Models\Prodact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductExport implements FromView
{
    // public function registerEvents(): array
    // {
    //     $styleArray = [
    //     'borders' => [
    //         'outline' => [
    //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
    //             'color' => ['argb' => 'FFFF0000'],
    //         ],
    //     ],
    // ];
    //     return $styleArray;
    // }

    // public function collection()
    // {
    //     $products = Prodact::select(
    //         'categories.name as category_name', 'prodacts.name as product_name',
    //         'prodacts.brand', 'prodacts.cost_price', 'prodacts.price_wholesale',
    //         'prodacts.price_max', 'price_min',
    //         )
    //     ->join('categories', 'categories.id', 'prodacts.category_id')
    //     ->get();
    //     return $products;
    // }

    public function view(): View
    {
        $products = Prodact::select(
            'categories.name as category_name', 'prodacts.id as product_id', 'prodacts.name as product_name',
            'prodacts.brand', 'prodacts.cost_price', 'prodacts.price_wholesale',
            'prodacts.price_max', 'price_min',
            )
        ->join('categories', 'categories.id', 'prodacts.category_id')
        ->get();
        return view('export.products', ['products'=>$products]);
    }
}
