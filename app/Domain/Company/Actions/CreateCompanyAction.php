<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;

class CreateCompanyAction{


    public function __invoke(CreateCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return new CompanyResource($company);
    }
}