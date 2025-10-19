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
        ]);

        $page = $validated['pagination'] ?? 10; 

        $products = Product::paginate($page);

        return ProductResource::collection($products);
    }
}