<?php

namespace App\Policies;

use App\Facades\UserPermissions;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('generos.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Cliente $cliente)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Cliente $cliente)
    {
        //
    }
}
