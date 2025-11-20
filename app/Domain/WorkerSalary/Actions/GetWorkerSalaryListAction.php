<?php

namespace App\Domain\WorkerSalary\Actions;

use App\Domain\WorkerSalary\Models\WorkerSalary;

class GetWorkerSalaryListAction{

    public function __invoke()
    {
        $worker_salaries  = WorkerSalary::with('worker')->get();

        return response()->json([
            'worker_salaries' => $worker_salaries
        ]);
    }
}