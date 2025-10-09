<?php

namespace App\Listeners;

use App\Events\MaterialActionEvent;
use App\Models\Action;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class MaterialActionListener
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
    public function handle(MaterialActionEvent $event)
    {
        Action::create([
            'user_id' => Auth::id() ?? 1,
            'action_type_id' => $event->action_type,
        ]);
    }
}
