<?php


namespace App\Services;

use App\Domain\Company\Models\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanySalesResource;
use Illuminate\Support\Facades\DB;


class CompanyService
{


    // use Illuminate\Support\Facades\DB;

    public function getCompanySales($id)
    {
        $company = Company::with([
            'payments',
            'sales.products'
        ])->findOrFail($id);

        return new CompanySalesResource($company);
    }


    public function companyDebtOverall($id)
    {
        $company = Company::query()
            ->with(['sales', 'payments'])
            ->withSum(['payments as paid_amount' => function ($query) {
                $query->whereNotNull('sale_id');
            }], 'amount')
            ->withSum(['payments as debt' => function ($query) {
                $query->whereNull('sale_id');
            }], 'amount')
            ->where('id', $id)
            ->firstOrFail();

        $paidAmount = (float) ($company->paid_amount ?? 0);
        $debt = (float) ($company->debt ?? 0);
        $deposit = $paidAmount - $debt;

        if ($deposit > 0) {
            return response()->json([
                'data' => []
            ]);
        }

        return new CompanyResource($company);
    }

    public function getInDebtedCompanies()
    {
        $companies = Company::query()
            ->select([
                'companies.*',
                DB::raw('COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NOT NULL), 0) as paid_amount'),
                DB::raw('COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NULL), 0) as debt'),
                DB::raw('COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NOT NULL), 0) - COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NULL), 0) as deposit')
            ])
            ->with(['sales', 'payments'])
            ->where(function ($query) {
                $query->whereRaw('COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NULL), 0) > 0')
                    ->orWhereRaw('COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NOT NULL), 0) - COALESCE((SELECT SUM(amount) FROM payments WHERE payments.company_id = companies.id AND payments.sale_id IS NULL), 0) < 0');
            })
            ->get();

        return CompanyResource::collection($companies);
    }
}
