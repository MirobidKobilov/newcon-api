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
            'pagination' => 'nullable|integer',
            'search' => 'nullable|string',
        ]);

        $page = $validated['pagination'] ?? 10;
        $search = $validated['search'] ?? null;

        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->paginate($page);

        return ProductResource::collection($products);
    }
}
