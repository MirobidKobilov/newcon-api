<?php

namespace App\Domain\Sale\Actions;

use App\Domain\Sale\Models\Sale;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;

class GetListSalesAction{

    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'pagination' => 'nullable|integer',
        ]);

        $page = $validate['pagination'] ?? 10;
        $sales = Sale::with('products')->paginate($page);

        return SaleResource::collection($sales);
    }
}