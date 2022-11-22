<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\ServicoAgendamento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServicoAgendamentoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('servicoagendamentos.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, ServicoAgendamento $servicoAgendamento)
    {
        return UserPermissions::isAuthorized('servicoagendamentos.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('servicoagendamentos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, ServicoAgendamento $servicoAgendamento)
    {
        return UserPermissions::isAuthorized('servicoagendamentos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, ServicoAgendamento $servicoAgendamento)
    {
        return UserPermissions::isAuthorized('servicoagendamentos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, ServicoAgendamento $servicoAgendamento)
    {
        //
    }

    public function forceDelete(User $user, ServicoAgendamento $servicoAgendamento)
    {
        //
    }
}
