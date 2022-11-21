<?php

namespace App\Policies;

use App\Models\Raca;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;
use Illuminate\Auth\Access\Response;

class RacaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('racas.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Raca $raca)
    {
        return UserPermissions::isAuthorized('racas.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('racas.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Raca $raca)
    {
        return UserPermissions::isAuthorized('racas.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Raca $raca)
    {
        return UserPermissions::isAuthorized('racas.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
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
