<?php

namespace App\Listeners;

use App\Events\UserCreateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreateEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(UserCreateEvent $event)
    {
        $event->user->sendUserCreateNotification($event->user, $event->password);
    }
}
