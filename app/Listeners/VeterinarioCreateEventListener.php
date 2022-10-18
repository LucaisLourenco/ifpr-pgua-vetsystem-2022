<?php

namespace App\Listeners;

use App\Events\VeterinarioCreateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VeterinarioCreateEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(VeterinarioCreateEvent $event)
    {
        $event->veterinario->sendVeterinarioCreateNotification($event->veterinario, $event->password);
    }
}
