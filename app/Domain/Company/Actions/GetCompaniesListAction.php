<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class GetCompaniesListAction{

    public function __invoke(Request $request)
    {

        $validate = $request->validate([
            'pagination' => 'nullable|integer'
        ]);

        $page = $validate['pagination'] ?? 10;
        $companies = Company::paginate($page);

        return CompanyResource::collection($companies);
    }
}