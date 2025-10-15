<?php

namespace App\Exports;

use App\Domain\Expance\Models\Expance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpanseExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Expance::with('user')->get()->map(function ($expanse) {
            return [
                'ID' => $expanse->id,
                'User Name' => $expanse->user ? $expanse->user->username : 'N/A',
                'Amount' => $expanse->amount,
                'Reason' => $expanse->reason,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Amount',
            'Reason',
        ];
    }
}
