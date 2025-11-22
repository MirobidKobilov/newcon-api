<?php

namespace App\Http\Controllers;

use App\Auth\Actions\LoginAction;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{

    protected $login_action;

    public function __construct(LoginAction $login_action)
    {
        $this->login_action = $login_action;
    }

    public function login(LoginRequest $request)
    {
        return $this->login_action->execute($request);
    }
}
