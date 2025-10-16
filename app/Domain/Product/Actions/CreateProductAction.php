<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class CreateProductAction
{
    public function __invoke(CreateProductRequest $request)
    {
        $validate = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validate['image'] = $path;
        }

        $product = Product::create($validate);

        return new ProductResource($product);
    }
}
