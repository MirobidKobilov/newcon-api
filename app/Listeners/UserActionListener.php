<?php

namespace App\Listeners;

use App\Events\UserActionEvent;
use App\Models\Action;
use App\Models\ActionType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UserActionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserActionEvent $event)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action_type_id' => $event->action_type,
        ]);
    }
}
