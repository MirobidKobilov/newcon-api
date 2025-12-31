<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Domain\Payment\Models\Payment;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetCompaniesListAction
{
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $search = strtolower($validated['search'] ?? '');

        $query = Company::query();


        $query->addSelect([
            '*',
            'total_paid_amount' => Payment::query()
                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                ->whereColumn('sales.company_id', 'companies.id')
                ->selectRaw('COALESCE(SUM(payments.amount), 0)')
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $companies = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $companies = $query->orderBy('updated_at', 'desc')->get();
        }

        return CompanyResource::collection($companies);
    }
}
