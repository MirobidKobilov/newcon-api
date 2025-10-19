<?php

namespace App\Services;

use App\Domain\Sale\Models\Sale;
use App\Http\Resources\SaleResource;
use Illuminate\Http\Request;

class DashboardService
{
    public function getSaleByDay(Request $request)
    {
        $day = $request->day;

        if (empty($day)) {
            return response()->json([
                'total_summa' => 0,
                'count' => 0,
                'data' => []
            ]);
        }

        $salesQuery = Sale::whereDate('created_at', $day);
        $total = $salesQuery->sum('summa');

        $sales = $salesQuery->paginate(5); 

        return response()->json([
            'total_summa' => $total,
            'count' => $sales->total(),
            'data' => SaleResource::collection($sales),
            'pagination' => [
                'current_page' => $sales->currentPage(),
                'last_page' => $sales->lastPage(),
                'per_page' => $sales->perPage(),
                'total' => $sales->total(),
            ],
        ]);
    }

    public function getSaleByMonth(Request $request)
    {
        $month = $request->month;

        if (empty($month)) {
            return response()->json([
                'total_summa' => 0,
                'count' => 0,
                'data' => []
            ]);
        }

        $salesQuery = Sale::whereMonth('created_at', $month);
        $total = $salesQuery->sum('summa');

        $sales = $salesQuery->paginate(5); 

        return response()->json([
            'total_summa' => $total,
            'count' => $sales->total(),
            'month' => $month,
            'data' => SaleResource::collection($sales),
            'pagination' => [
                'current_page' => $sales->currentPage(),
                'last_page' => $sales->lastPage(),
                'per_page' => $sales->perPage(),
                'total' => $sales->total(),
            ],
        ]);
    }
}
