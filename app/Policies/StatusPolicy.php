<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('statuses.index')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function view(User $user, Status $status)
    {
        return UserPermissions::isAuthorized('statuses.show')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function create(User $user)
    {
        return UserPermissions::isAuthorized('statuses.create')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function update(User $user, Status $status)
    {
        return UserPermissions::isAuthorized('statuses.edit')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function delete(User $user, Status $status)
    {
        return UserPermissions::isAuthorized('statuses.destroy')
            ? Response::allow()
            : abort(redirect()->route('acessonegado.index'));
    }

    public function restore(User $user, Status $status)
    {
        //
    }

    public function forceDelete(User $user, Status $status)
    {
        //
    }
}
