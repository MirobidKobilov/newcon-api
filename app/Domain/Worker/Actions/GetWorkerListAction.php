<?php

namespace App\Domain\Worker\Actions;

use App\Domain\Worker\Models\Worker;
use App\Http\Resources\WorkerResource;
use Illuminate\Http\Request;

class GetWorkerListAction
{
    public function execute(Request $request)
    {
        $data = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'search' => 'nullable|string',
        ]);

        $search = strtolower($data['search'] ?? '');

        $query = Worker::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(full_name) LIKE ?', ["%{$search}%"])
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhereRaw('LOWER(address) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(position) LIKE ?', ["%{$search}%"]);
            });
        }

        if (isset($data['index']) || isset($data['size'])) {
            $page = $data['index'] ?? 1;
            $size = $data['size'] ?? 10;
            $workers = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $workers = $query->get();
        }

        return WorkerResource::collection($workers);
    }
}
