<?php

namespace App\Listeners;

use App\Events\HomeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Facades\UserPermissions;

class HomeEventListener
{
    public function __construct()
    {
        //
    }

    public function handle(HomeEvent $event)
    {
        UserPermissions::loadPermissions($event->role);
    }
}
