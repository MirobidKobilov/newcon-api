<?php 

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;

class DeleteWorkerAction{

    public function __invoke($id)
    {
        $worker = Worker::findOrFail($id);

        $worker->delete();

        return response()->json([
            'message' => 'Worker deleted succesfully',
        ]);
    }
}