<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Sexo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SexoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('sexos.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Sexo $sexo)
    {
        return UserPermissions::isAuthorized('sexos.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('sexos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Sexo $sexo)
    {
        return UserPermissions::isAuthorized('sexos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Sexo $sexo)
    {
        return UserPermissions::isAuthorized('sexos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Sexo $sexo)
    {
        //
    }

    public function forceDelete(User $user, Sexo $sexo)
    {
        //
    }
}
