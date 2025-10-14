<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Spatie\Permission\Models\Role;

class RoleExport implements FromCollection , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Role::all(['name']);
    }

    public function headings(): array
    {
        return [
            'Name',
        ];
    }

    public function map($role): array
    {
        return [
            $role->name,
        ];
    }
}
