<?php

namespace App\Policies;

use App\Role;
use App\User;
use App\Classroom;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any classrooms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can view the classroom.
     *
     * @param  \App\User  $user
     * @param  \App\Classroom  $classroom
     * @return mixed
     */
    public function view(User $user, Classroom $classroom)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can create classrooms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can update the classroom.
     *
     * @param  \App\User  $user
     * @param  \App\Classroom  $classroom
     * @return mixed
     */
    public function update(User $user, Classroom $classroom)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can delete the classroom.
     *
     * @param  \App\User  $user
     * @param  \App\Classroom  $classroom
     * @return mixed
     */
    public function delete(User $user, Classroom $classroom)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the classroom.
     *
     * @param  \App\User  $user
     * @param  \App\Classroom  $classroom
     * @return mixed
     */
    public function restore(User $user, Classroom $classroom)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the classroom.
     *
     * @param  \App\User  $user
     * @param  \App\Classroom  $classroom
     * @return mixed
     */
    public function forceDelete(User $user, Classroom $classroom)
    {
        return false;
    }
}
