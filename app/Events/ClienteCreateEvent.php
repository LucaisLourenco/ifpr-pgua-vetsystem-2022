<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use PharIo\Manifest\Email;

class ClienteCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $cliente;
    public $password;

    public function __construct($cliente, $password)
    {
        $this->cliente = $cliente;
        $this->password = $password;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
