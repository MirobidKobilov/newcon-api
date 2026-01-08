<?php
namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class GetCompaniesListAction
{
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $search = isset($validated['search']) ? strtolower(trim($validated['search'])) : '';

        $query = Company::query()
            ->withSum('payments as paid_amount', 'amount');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $query->orderBy('updated_at', 'desc');

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $companies = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $companies = $query->get();
        }

        return CompanyResource::collection($companies);
    }
}