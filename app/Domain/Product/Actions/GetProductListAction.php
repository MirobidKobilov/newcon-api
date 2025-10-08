<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Http\Resources\ProductResource;


class GetProductListAction{

    public function __invoke()
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }
}