<?php

namespace App\Listeners;

use App\Events\ClienteCreateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Cliente;

class ClienteCreateEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(ClienteCreateEvent $event)
    {
        $event->cliente->sendClienteCreateNotification($event->cliente, $event->password);
    }
}
