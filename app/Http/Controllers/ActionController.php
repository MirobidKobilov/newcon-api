<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActionsResource;
use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    
    public function list(Request $request)
    {

        $validate = $request->validate([
            'pagination' => 'nullable|integer',
        ]);

        $page = $validate['pagination'] ?? 10;
        $actions = Action::paginate($page);

        return ActionsResource::collection($actions);
    }
}
