<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class GetCompaniesListAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $page = $validated['index'] ?? 1;
        $size = $validated['size'] ?? 10;
        $search = $validated['search'] ?? null;

        $query = Company::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $companies = $query->paginate($size, ['*'], 'page', $page);

        return CompanyResource::collection($companies);
    }
}
