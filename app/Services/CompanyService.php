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
            'sales.payments',
            'sales.products'
        ])
            ->selectRaw('
        companies.*,
        (
            SELECT COALESCE(SUM(payments.amount), 0)
            FROM payments
            INNER JOIN sales ON payments.sale_id = sales.id
            WHERE sales.company_id = companies.id
            AND payments.sale_id IS NOT NULL
        ) as total_payments
    ')
            ->findOrFail($id);

        return new CompanySalesResource($company);
    }


    public function companyDebtOverall($id)
    {
        $company = Company::query()
            ->with(['sales', 'payments'])
            // paid_amount: sale_id mavjud bo'lgan to'lovlar
            ->withSum(['payments as paid_amount' => function ($query) {
                $query->whereNotNull('sale_id');
            }], 'amount')
            // debt: sale_id null bo'lgan to'lovlar
            ->withSum(['payments as debt' => function ($query) {
                $query->whereNull('sale_id');
            }], 'amount')
            ->where('id', $id)
            ->firstOrFail();

        // Deposit <= 0 bo'lgan kompaniyalarni qaytarish
        $paidAmount = (float) ($company->paid_amount ?? 0);
        $debt = (float) ($company->debt ?? 0);
        $deposit = $paidAmount - $debt;

        // Agar deposit musbat bo'lsa (qarz yo'q), 404 qaytarish
        if ($deposit > 0) {
            return response()->json(['message' => 'Company has no debt'], 200);
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
