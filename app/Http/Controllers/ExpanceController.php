<?php

namespace App\Http\Controllers;

use App\Domain\Expance\Actions\CreateExpanceAction;
use App\Domain\Expance\Actions\GetListExpancesAction;
use App\Http\Requests\CreateExpenseRequest;
use Illuminate\Http\Request;

class ExpanceController extends Controller
{
    
    protected $expance_list;
    protected $create_expance;

    public function __construct(GetListExpancesAction $expance_list , CreateExpanceAction $create_expance)
    {
        $this->expance_list = $expance_list;
        $this->create_expance = $create_expance;
    }

    public function index()
    {
        return ($this->expance_list)();
    }

    public function create(CreateExpenseRequest $request)
    {
        return ($this->create_expance)($request);
    }
}
