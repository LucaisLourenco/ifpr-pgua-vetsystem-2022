<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\User;
use App\Models\VeterinarioEndereco;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VeterinarioEnderecoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, VeterinarioEndereco $veterinarioEndereco)
    {
        //
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('veterinarioEnderecos.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, VeterinarioEndereco $veterinarioEndereco)
    {
        return UserPermissions::isAuthorized('veterinarioEnderecos.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, VeterinarioEndereco $veterinarioEndereco)
    {
        return UserPermissions::isAuthorized('veterinarioEnderecos.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, VeterinarioEndereco $veterinarioEndereco)
    {
        //
    }

    public function forceDelete(User $user, VeterinarioEndereco $veterinarioEndereco)
    {
        //
    }
}
