<?php

namespace App\Exports;

use App\Domain\Product\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all(['name' , 'description' , 'quantity' , 'status']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Descrition',
            'Quantity',
            'Status'
        ];
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->description,
            $product->quantity,
            $product->status,
        ];
    }
}
