<?php

namespace App\Domain\Sale\Actions;

use App\Domain\Sale\Models\Sale;
use App\Http\Requests\CreateSaleRequest;
use App\Http\Resources\SaleResource;

class CreateSalesAction
{

    public function __invoke(CreateSaleRequest $request)
    {
        $data = $request->validated();

        $sale = Sale::create([
            'company_id' => $data['company_id'],
            'sales_type_id' => $data['sales_type_id'],
            'summa' => $data['summa'],
        ]);

        foreach ($data['products'] as $product) {
            $sale->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
            ]);
        }

        return new SaleResource($sale);
    }
}
