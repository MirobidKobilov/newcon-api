<?php

namespace App\Http\Controllers;

use App\Domain\Sale\Actions\CreateSalesAction;
use App\Domain\Sale\Actions\GetListSalesAction;
use App\Http\Requests\CreateSaleRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    
    protected $sales_list;
    protected $create_sale;

    public function __construct(GetListSalesAction $sales_list , CreateSalesAction $create_sale)
    {
        $this->sales_list = $sales_list;
        $this->create_sale = $create_sale;
    }

    public function index()
    {
        return ($this->sales_list)();
    }

    public function create(CreateSaleRequest $request)
    {
        return ($this->create_sale)($request);
    }
}
