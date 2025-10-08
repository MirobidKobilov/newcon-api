<?php

namespace App\Listeners;

use App\Events\ProductActionEvent;
use App\Models\Action;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class ProductActionListener
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
    public function handle(ProductActionEvent $event)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action_type_id' => $event->action_type,
        ]);
    }
}
