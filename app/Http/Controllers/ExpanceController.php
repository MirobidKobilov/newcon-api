<?php

namespace App\Http\Controllers;

use App\Domain\Expance\Actions\CreateExpanceAction;
use App\Domain\Expance\Actions\GetListExpancesAction;
use App\Domain\Expance\Actions\SearchExpancesAction;
use App\Exports\ExpanseExport;
use App\Http\Requests\CreateExpenseRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpanceController extends Controller
{
    
    protected $expance_list;
    protected $create_expance;
    protected $search_expanse;

    public function __construct(GetListExpancesAction $expance_list , CreateExpanceAction $create_expance , SearchExpancesAction $search_expance)
    {
        $this->expance_list = $expance_list;
        $this->create_expance = $create_expance;
        $this->search_expanse = $search_expance;
    }

    public function index(Request $request)
    {
        return ($this->expance_list)($request);
    }

    public function create(CreateExpenseRequest $request)
    {
        return ($this->create_expance)($request);
    }

    public function search(Request $request)
    {
        return ($this->search_expanse)($request);
    }

    public function export()
    {
        return Excel::download(new ExpanseExport , 'expanse.xlsx');
    }
}
