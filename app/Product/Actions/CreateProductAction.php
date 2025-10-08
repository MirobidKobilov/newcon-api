<?php

namespace App\Product\Actions;

use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Product\Models\Product;

class CreateProductAction{

    public function __invoke(CreateProductRequest $request)
    {
        $product = Product::create($request->validated());
        return new ProductResource($product);
    }
}