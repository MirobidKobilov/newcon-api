<?php

namespace App\Exports;

use App\Domain\Material\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MaterialExport implements FromCollection , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Material::with('material_type')->get(['name' , 'size' , 'quantity']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Size',
            'Quantity',

        ];
    }

    public function map($material): array
    {
        return [
            $material->name,
            $material->size,
            $material->quantity,
        ];
    }
}
