<?php


namespace App\Services;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanySalesResource;
use Illuminate\Support\Facades\DB;


class CompanyService
{


    // use Illuminate\Support\Facades\DB;

    public function getCompanySales($id)
    {
        $company = Company::with([
            'sales.payments',
            'sales.products'
        ])
            ->selectRaw('
        companies.*,
        (
            SELECT COALESCE(SUM(payments.amount), 0)
            FROM payments
            INNER JOIN sales ON payments.sale_id = sales.id
            WHERE sales.company_id = companies.id
            AND payments.sale_id IS NOT NULL
        ) as total_payments
    ')
            ->findOrFail($id);

        return new CompanySalesResource($company);
    }

    public function companyDebtOverall($id)
    {
        $company = Company::with([
            'sales',
            'payments' => function ($q) {
                $q->where('amount', '<=', 0);
            }
        ])
            ->where('id', $id)
            ->firstOrFail();

        return new CompanyResource($company);
    }



    public function getInDebtedCompanies()
    {
        $companies = Company::whereHas('payments', function ($query) {
            $query->where('amount', '>', 0);
        })
            ->with('payments')
            ->get();

        return CompanyResource::collection($companies);
    }
}
