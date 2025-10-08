<?php

namespace App\Domain\User\Actions;

use App\Http\Resources\UserResource;
use App\Models\User;

class GetUsersListAction{

    public function __invoke()
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
    }
}