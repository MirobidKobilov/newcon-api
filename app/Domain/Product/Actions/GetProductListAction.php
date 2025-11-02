<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class GetProductListAction
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
        $search = strtolower($validated['search'] ?? '');

        $query = Product::query();

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);
        }

        $products = $query->paginate($size, ['*'], 'page', $page);

        return ProductResource::collection($products);
    }
}
