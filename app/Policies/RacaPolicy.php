<?php

namespace App\Policies;

use App\Models\Raca;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;

class RacaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('racas.index');
    }

    public function view(User $user, Raca $raca)
    {
        return UserPermissions::isAuthorized('racas.index');
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('racas.create');
    }

    public function update(User $user, Raca $raca)
    {
        return UserPermissions::isAuthorized('racas.edit');
    }

    public function delete(User $user, Raca $raca)
    {
        return UserPermissions::isAuthorized('racas.destroy');
    }

    public function restore(User $user, Raca $raca)
    {
        //
    }

    public function forceDelete(User $user, Raca $raca)
    {
        //
    }
}
