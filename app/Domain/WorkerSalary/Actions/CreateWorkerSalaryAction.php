<?php

namespace App\Domain\WorkerSalary\Actions;

use App\Domain\WorkerSalary\Models\WorkerSalary;
use Illuminate\Http\Request;

class CreateWorkerSalaryAction{

    public function execute(Request $request)
    {
        $data = $request->validate([
            'worker_id' => 'required|integer',
            'salary' => 'required|integer',
        ]);

        $worker_salary = WorkerSalary::create($data);

        return response()->json([
            'worker_salary' => $worker_salary 
        ]);
    }
}