<?php

namespace App\Domain\Expance\Actions;

use App\Domain\Expance\Models\Expance;
use App\Http\Resources\ExpanceResource;
use Illuminate\Http\Request;

class GetListExpancesAction{

    public function __invoke(Request $request)
    {

        $validate = $request->validate([
            'pagination' => 'nullable|integer',
        ]);

        $page = $validate['pagination'] ?? 10;
        $expances = Expance::paginate($page);

        return ExpanceResource::collection($expances);
    }   
}