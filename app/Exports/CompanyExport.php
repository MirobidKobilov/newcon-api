<?php

namespace App\Exports;

use App\Domain\Company\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CompanyExport implements FromCollection , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::all(['name' , 'phone' , 'address' , 'deposit']);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
            'Address',
            'Deposit'
        ];
    }

    public function map($company): array
    {
        return [
            $company->name,
            $company->phone,
            $company->address,
            $company->deposit,
        ];
    }
}
