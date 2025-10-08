<?php

namespace App\Product\Actions;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Product\Models\Product;

class UpdateProductAction{

    public function __invoke(UpdateProductRequest $request , $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->validated());
        
        return new ProductResource($product);
    }
}