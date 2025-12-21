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
        $company = Company::with(['sales', 'payments'])
            ->where('id', $id)
            ->where('deposit', '<=',  0)
            ->firstOrFail();

        return new CompanyResource($company);
    }

    public function getInDebtedCompanies()
    {
        $companies = Company::where('debt', '>', 0)->orWhere('deposit', '<', 0)->get();

        return CompanyResource::collection($companies);
    }
}
