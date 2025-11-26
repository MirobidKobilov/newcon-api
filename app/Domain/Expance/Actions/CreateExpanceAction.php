<?php

namespace App\Domain\Expance\Actions;

use App\Domain\Expance\Models\Expance;
use App\Http\Requests\CreateExpenseRequest;
use App\Http\Resources\ExpanceResource;

class CreateExpanceAction{

    public function execute(CreateExpenseRequest $request)
    {
        $expanse = Expance::create($request->validated());
        return new ExpanceResource($expanse);
    }
}