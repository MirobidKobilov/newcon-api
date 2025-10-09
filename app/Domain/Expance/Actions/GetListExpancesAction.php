<?php

namespace App\Domain\Expance\Actions;

use App\Domain\Expance\Models\Expance;
use App\Http\Resources\ExpanceResource;

class GetListExpancesAction{

    public function __invoke()
    {
        $expances = Expance::paginate(10);

        return ExpanceResource::collection($expances);
    }   
}