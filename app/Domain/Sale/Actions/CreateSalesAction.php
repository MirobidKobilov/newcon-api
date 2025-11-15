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
        return $request;
        $data = $request->validated();

        $summa = 0;

        $company = Company::findOrFail($data['company_id']);

        foreach ($data['products'] as $product) {
            $product = Product::findOrFail($product['product_id']);
            $summa += $product->price * $product['quantity'];
        }

        $sale = Sale::create([
            'company_id' => $data['company_id'],
            'summa' => $summa,
        ]);
        
        $company->deposit  -= $summa;
        $company->save();
        foreach ($data['products'] as $product) {
            $sale->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                // 'sales_type_id' => $data['sales_type_id'],
            ]);
        }

        return new SaleResource($sale);
    }
}
