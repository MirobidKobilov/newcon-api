<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::with('roles')->get(['username', 'phone']);
    }

    public function headings(): array
    {
        return [
            'Username',
            'Phone',
            'Roles',
        ];
    }

    public function map($user): array
    {
        $roles = $user->roles->pluck('name')->join(', ');
        return [
            $user->username,
            $user->phone,
            $roles,
        ];
    }
}
