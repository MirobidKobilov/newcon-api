<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetProductListAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'pagination' => 'nullable|integer',
            'search' => 'nullable|string',
        ]);

        $page = $validated['pagination'] ?? 10;
        $search = strtolower($validated['search'] ?? '');

        $query = Product::query();

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);
        }

        $products = $query->paginate($page);

        return ProductResource::collection($products);
    }
}
