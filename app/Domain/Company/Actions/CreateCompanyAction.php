<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;

class CreateCompanyAction{


    public function execute(CreateCompanyRequest $request)
    {
        $company = new Company();

        $company->name = $request->name;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->save();

        return new CompanyResource($company);
    }
}