<?php

namespace App\Services;

use App\Domain\Sale\Models\Sale;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;

class DashboardService{

    public function getSaleByDay(Request $request)
    {
        $day = $request->day;
        $sale = Sale::whereDate('created_at' , $day)->get();

        return SaleResource::collection($sale);
    }

    public function getSaleByMonth(Request $request)
    {
        $month = $request->month;

        $sale = Sale::whereMonth('created_at' , $month)->get();

        return SaleResource::collection($sale);
    }
}