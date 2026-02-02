<?php


namespace App\Services;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanySalesResource;
use Illuminate\Support\Facades\DB;
class CompanyService
{
    public function getCompanySales($id)
    {
        $company = Company::with([
            'payments',
            'sales.products'
        ])->findOrFail($id);

        return new CompanySalesResource($company);
    }
}
