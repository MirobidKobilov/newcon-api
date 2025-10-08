<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;

class DeleteCompanyAction{

    public function __invoke($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return response()->json([
            'message' => 'Company deleted succesfully',
        ]);
    }
}