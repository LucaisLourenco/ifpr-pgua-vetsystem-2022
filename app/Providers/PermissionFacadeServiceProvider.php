<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Facades\UserPermissions;

class PermissionFacadeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('userpermissions',function() { 
            return new UserPermissions(); 
        });
    }

    public function boot()
    {
        //
    }
}
