<?php

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;
use App\Http\Resources\WorkerResource;

class GetWorkerAction{

    public function __invoke($id)
    {
        $worker = Worker::with('workerSalary')->findOrFail($id);

        return new WorkerResource($worker);
    }
}