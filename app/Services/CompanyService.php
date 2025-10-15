<?php


namespace App\Services;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanySalesResource;

class CompanyService{

    public function getCompanySales($id)
    {
        $company = Company::with('sales')->findOrFail($id);

        return new CompanySalesResource($company);
    }
}