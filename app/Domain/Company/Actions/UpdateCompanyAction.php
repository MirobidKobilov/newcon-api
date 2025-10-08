<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;

class UpdateCompanyAction{

    public function __invoke(UpdateCompanyRequest $request , $id)
    {
        $data = $request->validated();

        $company = Company::findOrFail($id);

        $company->update($data);

        return new CompanyResource($company);
    }
}