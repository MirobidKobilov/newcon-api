<?php

namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class GetListPaymentsAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'pagination' => 'nullable|integer',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'search' => 'nullable|string',
        ]);

        $page = $validated['pagination'] ?? 10;
        $from = $validated['from_date'] ?? null;
        $to = $validated['to_date'] ?? null;
        $search = $validated['search'] ?? null;

        $query = Payment::with(['sales.company']); // include sales and their company

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('created_at', '>=', $from);
        } elseif ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($search) {
            $query->whereHas('sales.company', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $payments = $query->paginate($page);

        return PaymentResource::collection($payments);
    }
}
