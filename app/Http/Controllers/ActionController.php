<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActionsResource;
use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    
    public function list()
    {
        $actions = Action::paginate(10);

        return ActionsResource::collection($actions);
    }
}
