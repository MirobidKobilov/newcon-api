<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboard_service;

    public function __construct(DashboardService $dashboard_service)
    {
        $this->dashboard_service = $dashboard_service;
    }

    public function getSaleByDay(Request $request)
    {
        return $this->dashboard_service->getSaleByDay($request);
    }

    public function getSaleByMonth(Request $request)
    {
        return $this->dashboard_service->getSaleByMonth($request);
    }
}
