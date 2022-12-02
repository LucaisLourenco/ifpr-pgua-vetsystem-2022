<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\User;
use App\Models\VeterinarioEspecialidade;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VeterinarioEspecialidadePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('veterinarios.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function delete(User $user, VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function restore(User $user, VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }

    public function forceDelete(User $user, VeterinarioEspecialidade $veterinarioEspecialidade)
    {
        //
    }
}
