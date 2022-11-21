<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\ClienteTelefone;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClienteTelefonePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, ClienteTelefone $clienteTelefone)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('clienteTelefones.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, ClienteTelefone $clienteTelefone)
    {
        return UserPermissions::isAuthorized('clienteTelefones.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, ClienteTelefone $clienteTelefone)
    {
        return UserPermissions::isAuthorized('clienteTelefones.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, ClienteTelefone $clienteTelefone)
    {
        //
    }

    public function forceDelete(User $user, ClienteTelefone $clienteTelefone)
    {
        //
    }
}
