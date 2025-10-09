<?php

namespace App\Events;

use App\Domain\Material\Models\Material;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MaterialActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $material;
    public $action_type;
    /**
     * Create a new event instance.
     */
    public function __construct(Material $material , string $action_type)
    {
        $this->material = $material;
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
