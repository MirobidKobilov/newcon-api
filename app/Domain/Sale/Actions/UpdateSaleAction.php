<?php

namespace App\Domain\Sale\Actions;

use App\Domain\Sale\Models\Sale;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;

class UpdateSaleAction{

    public function execute(Request $request , $id)
    {
        $data = $request->validate([
            'company_id' => 'nullable|integer|exists:companies,id',
            'status' => 'nullable|string'
        ]);

        $sale = Sale::findOrFail($id);

        $sale->update($data);

        return new SaleResource($sale);
    }
}