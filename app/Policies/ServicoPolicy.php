<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Servico;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServicoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('servicos.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Servico $servico)
    {
        return UserPermissions::isAuthorized('servicos.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('servicos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Servico $servico)
    {
        return UserPermissions::isAuthorized('servicos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Servico $servico)
    {
        return UserPermissions::isAuthorized('servicos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Servico $servico)
    {
        //
    }

    public function forceDelete(User $user, Servico $servico)
    {
        //
    }
}
