<?php

namespace App\Domain\Sale\Actions;

use App\Domain\Sale\Models\Sale;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;

class GetListSalesAction
{
    public function __invoke(Request $request)
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

        $query = Sale::with(['company', 'products']);

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('created_at', '>=', $from);
        } elseif ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($search) {
            $query->whereHas('company', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
            });
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $sales = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $sales = $query->get();
        }

        return SaleResource::collection($sales);
    }
}
