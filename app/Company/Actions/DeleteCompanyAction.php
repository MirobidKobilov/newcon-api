<?php

namespace App\Company\Actions;

use App\Company\Models\Company;

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