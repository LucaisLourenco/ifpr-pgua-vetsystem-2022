<?php

namespace App\Policies;

use App\Models\Especie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;
use Illuminate\Auth\Access\Response;

class EspeciePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('especies.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Especie $especy)
    {
        return UserPermissions::isAuthorized('especies.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('especies.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Especie $especy)
    {
        return UserPermissions::isAuthorized('especies.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Especie $especy)
    {
        return UserPermissions::isAuthorized('especies.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Especie $especy)
    {
        //
    }

    public function forceDelete(User $user, Especie $especy)
    {
        //
    }
}
