<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VeterinarioCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $veterinario;
    public $password;

    public function __construct($veterinario, $password)
    {
        $this->veterinario = $veterinario;
        $this->password = $password;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
