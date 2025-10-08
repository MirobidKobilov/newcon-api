<?php

namespace App\Domain\Sale\Actions;

use App\Domain\Sale\Models\Sale;
use App\Http\Resources\SaleResource;

class GetListSalesAction{

    public function __invoke()
    {
        $sales = Sale::with('products')->paginate(10);

        return SaleResource::collection($sales);
    }
}