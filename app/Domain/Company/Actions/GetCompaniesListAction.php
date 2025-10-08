<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;

class GetCompaniesListAction{

    public function __invoke()
    {
        $companies = Company::paginate(10);

        return CompanyResource::collection($companies);
    }
}