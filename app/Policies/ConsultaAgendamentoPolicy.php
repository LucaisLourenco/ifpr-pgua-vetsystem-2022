<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\ConsultaAgendamento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ConsultaAgendamentoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('consultaagendamentos.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, ConsultaAgendamento $consultaAgendamento)
    {
        return UserPermissions::isAuthorized('consultaagendamentos.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('consultaagendamentos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, ConsultaAgendamento $consultaAgendamento)
    {
        return UserPermissions::isAuthorized('consultaagendamentos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, ConsultaAgendamento $consultaAgendamento)
    {
        return UserPermissions::isAuthorized('consultaagendamentos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, ConsultaAgendamento $consultaAgendamento)
    {
        //
    }

    public function forceDelete(User $user, ConsultaAgendamento $consultaAgendamento)
    {
        //
    }
}
