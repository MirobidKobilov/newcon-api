<?php

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;
use App\Http\Resources\WorkerResource;
use Illuminate\Http\Request;

class GetWorkerListAction
{

    public function __invoke(Request $request)
    {

        $data = $request->validate([
            'index' => 'nullable|min:1',
            'size' => 'nullable|min:1',
            'search' => 'nullable|string',
        ]);

        $page = $data['index'] ?? 1;
        $size = $data['size'] ?? 10;
        $search = $data['search'] ?? null;

        $query = Worker::query();

        if($search){
            $query->where(function ($q) use ($search) {
                $q->where('full_name' , 'like' , "%{$search}%")
                    ->orWhere('phone' , 'like' , "%{$search}%")
                    ->orWhere('address' , 'like' , "%{$search}%")
                    ->orWhere('position' , 'like' , "%{$search}%");
            });
        }

        $workers = $query->paginate($size , ['*'] , 'page' , $page);

        return WorkerResource::collection($workers);
    }
}
