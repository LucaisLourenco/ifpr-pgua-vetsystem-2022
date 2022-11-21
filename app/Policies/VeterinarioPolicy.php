<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\User;
use App\Models\Veterinario;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VeterinarioPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('veterinarios.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Veterinario $veterinario)
    {
        return UserPermissions::isAuthorized('veterinarios.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('veterinarios.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Veterinario $veterinario)
    {
        return UserPermissions::isAuthorized('veterinarios.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Veterinario $veterinario)
    {
        return UserPermissions::isAuthorized('veterinarios.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Veterinario $veterinario)
    {
        //
    }

    public function forceDelete(User $user, Veterinario $veterinario)
    {
        //
    }
}
