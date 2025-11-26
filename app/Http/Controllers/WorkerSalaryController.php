<?php

namespace App\Http\Controllers;

use App\Domain\WorkerSalary\Actions\CreateWorkerSalaryAction;
use App\Domain\WorkerSalary\Actions\GetWorkerSalaryListAction;
use Illuminate\Http\Request;

class WorkerSalaryController extends Controller
{
    protected $salaries;
    protected $create_salary;

    public function __construct(GetWorkerSalaryListAction $salary_list , CreateWorkerSalaryAction $create_worker_salary)
    {
        $this->salaries = $salary_list;
        $this->create_salary  = $create_worker_salary;
    }

    public function list()
    {
        return $this->salaries->execute();
    }

    public function create(Request $request)
    {
        return $this->create_salary->execute($request);
    }
}
