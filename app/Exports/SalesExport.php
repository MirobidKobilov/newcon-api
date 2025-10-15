<?php

namespace App\Exports;

use App\Domain\Sale\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Sale::with(['company', 'products'])->get()->map(function ($sale) {
            return [
                'Sale ID' => $sale->id,
                'Company Name' => $sale->company ? $sale->company->name : 'N/A',
                'Products' => $sale->products->pluck('name')->join(', '),
                'Summa' => $sale->summa,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Sale ID',
            'Company Name',
            'Products',
            'Summa',
        ];
    }
}
