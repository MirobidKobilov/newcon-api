<?php 

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;

class DeleteWorkerAction{

    public function execute($id)
    {
        $worker = Worker::findOrFail($id);

        $worker->delete();

        return response()->json([
            'message' => 'Worker deleted succesfully',
        ]);
    }
}