<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\ClienteEndereco;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ClienteEnderecoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, ClienteEndereco $clienteEndereco)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('clienteEnderecos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, ClienteEndereco $clienteEndereco)
    {
        return UserPermissions::isAuthorized('clienteEnderecos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, ClienteEndereco $clienteEndereco)
    {
        return UserPermissions::isAuthorized('clienteEnderecos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, ClienteEndereco $clienteEndereco)
    {
        //
    }

    public function forceDelete(User $user, ClienteEndereco $clienteEndereco)
    {
        //
    }
}
