<?php

namespace App\Policies;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;
use Illuminate\Auth\Access\Response;

class GeneroPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('generos.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Genero $genero)
    {
        return UserPermissions::isAuthorized('generos.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('generos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Genero $genero)
    {
        return UserPermissions::isAuthorized('generos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Genero $genero)
    {
        return UserPermissions::isAuthorized('generos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Genero $genero)
    {
        
    }

    public function forceDelete(User $user, Genero $genero)
    {
        
    }
}
