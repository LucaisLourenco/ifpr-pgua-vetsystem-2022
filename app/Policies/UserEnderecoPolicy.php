<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\User;
use App\Models\UserEndereco;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserEnderecoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, UserEndereco $userEndereco)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('userEnderecos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, UserEndereco $userEndereco)
    {
        return UserPermissions::isAuthorized('userEnderecos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, UserEndereco $userEndereco)
    {
        return UserPermissions::isAuthorized('userEnderecos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, UserEndereco $userEndereco)
    {
        //
    }

    public function forceDelete(User $user, UserEndereco $userEndereco)
    {
        //
    }
}
