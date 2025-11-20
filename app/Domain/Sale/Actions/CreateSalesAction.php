<?php

namespace App\Domain\Sale\Actions;

use App\Domain\Company\Models\Company;
use App\Domain\Sale\Models\Sale;
use App\Domain\Product\Models\Product;
use App\Http\Requests\CreateSaleRequest;
use App\Http\Resources\SaleResource;

class CreateSalesAction
{
    public function __invoke(CreateSaleRequest $request)
    {
        $data = $request->validated();

        $summa = $data['summa'];

        $company = Company::findOrFail($data['company_id']);

        $sale = Sale::create([
            'company_id' => $data['company_id'],
            'summa' => $summa,
        ]);

        $company->deposit -= $summa;
        $company->save();

        foreach ($data['products'] as $product) {
            $sale->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price']
                
            ]);
        }

        return new SaleResource($sale);
    }
}
