<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\User;
use App\Models\UserTelefone;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserTelefonePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, UserTelefone $userTelefone)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('userTelefones.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, UserTelefone $userTelefone)
    {
        return UserPermissions::isAuthorized('userTelefones.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, UserTelefone $userTelefone)
    {
        return UserPermissions::isAuthorized('userTelefones.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, UserTelefone $userTelefone)
    {
        //
    }

    public function forceDelete(User $user, UserTelefone $userTelefone)
    {
        //
    }
}
