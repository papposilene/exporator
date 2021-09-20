<?php

namespace App\Policies;

use App\Models\Museum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Jetstream\HasTeams;

class MuseumPolicy
{
    use HandlesAuthorization, hasTeamPermission;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Museum $museum)
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
        return $user->hasTeamPermission($server->team, 'server:update');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Museum $museum)
    {
        return $user->hasTeamPermission($server->team, 'server:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Museum $museum)
    {
        return $user->hasTeamPermission($server->team, 'server:update');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Museum $museum)
    {
        return $user->hasTeamPermission($server->team, 'server:update');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Museum $museum)
    {
        //
    }
}
