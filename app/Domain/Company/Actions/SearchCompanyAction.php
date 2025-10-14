<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class SearchCompanyAction{

    public function __invoke(Request $request)
    {
        $term = $request->term;

        $term = trim($term);

        if(empty($term)){
            return CompanyResource::collection(Company::all());
        }

        $company = Company::where('name' , 'LIKE' , "%{$term}%")
                    ->orWhere('phone' , 'LIKE' , "%{$term}%")
                    ->orWhere('address' , 'LIKE' , "%{$term}%")
                    ->orWhere('deposit' , 'LIKE' , "%{$term}%")
                    ->get();
        
        return CompanyResource::collection($company);
        
    }
}