<?php

namespace App\Policies;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;

class GeneroPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //return UserPermissions::isAuthorized('generos.index');
    }

    public function view(User $user, Genero $genero)
    {
        //return UserPermissions::isAuthorized('generos.show');
    }

    public function create(User $user)
    {
        //return UserPermissions::isAuthorized('generos.create');
    }

    public function update(User $user, Genero $genero)
    {
        //return UserPermissions::isAuthorized('generos.edit');
    }

    public function delete(User $user, Genero $genero)
    {
        //return UserPermissions::isAuthorized('generos.destroy');
    }

    public function restore(User $user, Genero $genero)
    {
        //
    }

    public function forceDelete(User $user, Genero $genero)
    {
        //
    }
}
