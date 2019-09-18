<?php

namespace App\Policies;

use App\Role;
use App\User;
use App\Discipline;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisciplinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any disciplines.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can view the discipline.
     *
     * @param \App\User $user
     * @param \App\Discipline $discipline
     * @return mixed
     */
    public function view(User $user, Discipline $discipline)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can create disciplines.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can update the discipline.
     *
     * @param \App\User $user
     * @param \App\Discipline $discipline
     * @return mixed
     */
    public function update(User $user, Discipline $discipline)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can delete the discipline.
     *
     * @param \App\User $user
     * @param \App\Discipline $discipline
     * @return mixed
     */
    public function delete(User $user, Discipline $discipline)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the discipline.
     *
     * @param \App\User $user
     * @param \App\Discipline $discipline
     * @return mixed
     */
    public function restore(User $user, Discipline $discipline)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the discipline.
     *
     * @param \App\User $user
     * @param \App\Discipline $discipline
     * @return mixed
     */
    public function forceDelete(User $user, Discipline $discipline)
    {
        return false;
    }
}
