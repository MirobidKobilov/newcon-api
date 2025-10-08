<?php

namespace App\Product\Actions;

use App\Http\Resources\ProductResource;
use App\Product\Models\Product;

class GetProductListAction{

    public function __invoke()
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }
}