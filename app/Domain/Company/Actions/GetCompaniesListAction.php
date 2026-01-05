<?php
namespace App\Domain\Company\Actions;

use App\Domain\Company\Models\Company;
use App\Domain\Payment\Models\Payment;
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

        $search = strtolower($validated['search'] ?? '');

        $query = Company::query();

        $query->addSelect([
            '*',
            
            // ✅ 1. total_paid_amount - Sale ID bor bo'lgan payment lar (ESKI LOGIKA)
            'total_paid_amount' => Payment::query()
                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                ->whereColumn('sales.company_id', 'companies.id')
                ->selectRaw('COALESCE(SUM(payments.amount), 0)'),
            
            // ✅ 2. payment - Sale ID YO'Q bo'lgan payment lar (payment_sales dan)
            'payment' => DB::table('payment_sales')
                ->join('payments', 'payment_sales.payment_id', '=', 'payments.id')
                ->whereColumn('payment_sales.company_id', 'companies.id')
                ->whereNull('payments.sale_id')  // ← Sale bo'lmagan
                ->selectRaw('COALESCE(SUM(payment_sales.amount), 0)'),
            
            // ✅ 3. debt = total_paid_amount - payment
            'debt' => DB::raw('
                COALESCE((
                    SELECT SUM(p.amount)
                    FROM payments p
                    JOIN sales s ON p.sale_id = s.id
                    WHERE s.company_id = companies.id
                ), 0) - 
                COALESCE((
                    SELECT SUM(ps.amount)
                    FROM payment_sales ps
                    JOIN payments p2 ON ps.payment_id = p2.id
                    WHERE ps.company_id = companies.id
                      AND p2.sale_id IS NULL
                ), 0)
            ')
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $companies = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $companies = $query->orderBy('updated_at', 'desc')->get();
        }

        return CompanyResource::collection($companies);
    }
}