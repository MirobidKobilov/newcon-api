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
                'data' => []
            ]);
        }

        $sales = Sale::whereDate('created_at', $day)->get();

        $total = $sales->sum('summa');

        return response()->json([
            'total_summa' => $total,
            'count' => $sales->count(),
            'data' => SaleResource::collection($sales)
        ]);
    }

    public function getSaleByMonth(Request $request)
    {
        $month = $request->month;

        if (empty($month)) {
            return response()->json([
                'total_summa' => 0,
                'data' => []
            ]);
        }

        $sales = Sale::whereMonth('created_at', $month)
            ->get();

        $totalSumma = $sales->sum('summa');

        return response()->json([
            'total_summa' => $totalSumma,
            'count' => $sales->count(),
            'month' => $month,
            'data' => SaleResource::collection($sales)
        ]);
    }
}
