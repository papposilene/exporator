<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Jetstream\HasTeams;

class UserPolicy
{
    use HandlesAuthorization, hasTeams;

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
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
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
        $team = Team::where('id', $user->current_team_id)->first();

        return $user->hasTeamPermission($team, 'server:update');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        $team = Team::where('id', $user->current_team_id)->first();

        return $user->hasTeamPermission($team, 'server:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        $team = Team::where('id', $user->current_team_id)->first();

        return $user->hasTeamPermission($team, 'server:update');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        $team = Team::where('id', $user->current_team_id)->first();

        return $user->hasTeamPermission($team, 'server:update');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
    }
}
