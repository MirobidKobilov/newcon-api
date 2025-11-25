<?php

namespace App\Domain\Payment\Actions;

use App\Domain\Payment\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class GetListPaymentsAction
{
    public function execute(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'search' => 'nullable|string',
        ]);

        $from = $validated['from_date'] ?? null;
        $to = $validated['to_date'] ?? null;
        $search = strtolower($validated['search'] ?? '');

        $query = Payment::with(['companies' , 'user']);

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('created_at', '>=', $from);
        } elseif ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(uuid) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('companies', function ($sub) use ($search) {
                        $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    });
            });
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $payments = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $payments = $query->get();
        }

        return PaymentResource::collection($payments);
    }
}
