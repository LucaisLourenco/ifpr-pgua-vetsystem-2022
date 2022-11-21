<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;
use Illuminate\Auth\Access\Response;

class PetPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('pets.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Pet $pet)
    {
        return UserPermissions::isAuthorized('pets.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('pets.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Pet $pet)
    {
        return UserPermissions::isAuthorized('pets.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Pet $pet)
    {
        return UserPermissions::isAuthorized('pets.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Pet $pet)
    {
        //
    }

    public function forceDelete(User $user, Pet $pet)
    {
        //
    }
}
