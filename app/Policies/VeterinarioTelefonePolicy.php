<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\User;
use App\Models\VeterinarioTelefone;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VeterinarioTelefonePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, VeterinarioTelefone $veterinarioTelefone)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('veterinarioTelefones.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, VeterinarioTelefone $veterinarioTelefone)
    {
        return UserPermissions::isAuthorized('veterinarioTelefones.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, VeterinarioTelefone $veterinarioTelefone)
    {
        return UserPermissions::isAuthorized('veterinarioTelefones.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, VeterinarioTelefone $veterinarioTelefone)
    {
        //
    }

    public function forceDelete(User $user, VeterinarioTelefone $veterinarioTelefone)
    {
        //
    }
}
