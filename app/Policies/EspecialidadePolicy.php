<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Especialidade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EspecialidadePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('especialidades.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Especialidade $especialidade)
    {
        return UserPermissions::isAuthorized('especialidades.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('especialidades.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Especialidade $especialidade)
    {
        return UserPermissions::isAuthorized('especialidades.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Especialidade $especialidade)
    {
        return UserPermissions::isAuthorized('especialidades.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Especialidade $especialidade)
    {
        //
    }

    public function forceDelete(User $user, Especialidade $especialidade)
    {
        //
    }
}
