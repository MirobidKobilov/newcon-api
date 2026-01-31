<?php
namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->withSum(['payments as paid_amount' => function ($query) {
                $query->whereNotNull('sale_id');
            }], 'amount')
            ->withSum(['payments as debt' => function ($query) {
                $query->whereNull('sale_id');
            }], 'amount')
            ->addSelect([
                'companies.*',
                DB::raw('(
                    COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NOT NULL), 0) - 
                    COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NULL), 0)
                ) as deposit')
            ]);

        $query->withSum('sales as sold_amount', 'summa');
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