<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientePolicy
{
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('clientes.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Cliente $cliente)
    {
        return UserPermissions::isAuthorized('clientes.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('clientes.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Cliente $cliente)
    {
        return UserPermissions::isAuthorized('clientes.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Cliente $cliente)
    {
        return UserPermissions::isAuthorized('clientes.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Cliente $cliente)
    {
        //
    }

    public function forceDelete(User $user, Cliente $cliente)
    {
        //
    }
}
