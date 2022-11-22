<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Peso;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PesoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Peso $peso)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('pets.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Peso $peso)
    {
        return UserPermissions::isAuthorized('pets.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Peso $peso)
    {
        return UserPermissions::isAuthorized('pets.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Peso $peso)
    {
        //
    }

    public function forceDelete(User $user, Peso $peso)
    {
        //
    }
}
