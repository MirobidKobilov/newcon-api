<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;


class CreateProductAction{

    public function __invoke(CreateProductRequest $request)
    {
        $product = Product::create($request->validated());
        return new ProductResource($product);
    }
}