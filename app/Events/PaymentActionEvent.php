<?php

namespace App\Events;

use App\Domain\Payment\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;
    public $action_type;
    /**
     * Create a new event instance.
     */
    public function __construct(Payment $payment , string $action_type)
    {
        $this->payment =  $payment;
        $this->action_type = $action_type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
