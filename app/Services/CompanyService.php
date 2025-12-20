<?php


namespace App\Services;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanySalesResource;

class CompanyService
{

    public function getCompanySales($id)
    {
        $company = Company::with('sales')->findOrFail($id);

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
