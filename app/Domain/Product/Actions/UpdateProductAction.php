<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class UpdateProductAction{

    public function __invoke(UpdateProductRequest $request , $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->validated());
        
        return new ProductResource($product);
    }
}