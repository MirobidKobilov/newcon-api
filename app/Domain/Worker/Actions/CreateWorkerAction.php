<?php 

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Resources\WorkerResource;

class CreateWorkerAction{

    public function __invoke(CreateWorkerRequest $request)
    {
        $data = $request->validated();

        $worker = Worker::create($data);

        return new WorkerResource($worker);
    }
}