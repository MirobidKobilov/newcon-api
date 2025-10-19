<?php

namespace App\Listeners;

use App\Events\PaymentActionEvent;
use App\Models\Action;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class PaymentActionListener
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
    public function handle(PaymentActionEvent $event): void
    {
        Action::create([
            'user_id' => Auth::id() ?? 1,
            'action_type_id' => $event->action_type,
        ]);
    }
}
