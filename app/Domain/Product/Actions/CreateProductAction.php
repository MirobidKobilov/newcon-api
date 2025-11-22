<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class CreateProductAction
{
    public function execute(CreateProductRequest $request)
    {
        $product = new Product();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->status = 1;
        $product->save();

        return new ProductResource($product);
    }
}
