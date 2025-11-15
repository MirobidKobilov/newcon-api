<?php 

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\WorkerResource;

class UpdateWorkerAction{

    public function __invoke(UpdateWorkerRequest $request , $id)
    {
        $data = $request->validated();

        $worker = Worker::findOrFail($id);

        $worker->update($data);

        return new WorkerResource($worker);
    }
}