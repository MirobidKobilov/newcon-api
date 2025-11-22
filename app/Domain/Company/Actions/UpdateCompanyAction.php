<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;

class UpdateCompanyAction{

    public function execute(UpdateCompanyRequest $request , $id)
    {
        $company = Company::findOrFail($id);

        $company->name = $request->name ?? $company->name;
        $company->phone = $request->phone ?? $company->phone;
        $company->address = $request->address ?? $company->address;

        $company->save();

        return new CompanyResource($company);
    }
}