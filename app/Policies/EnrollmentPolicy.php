<?php

namespace App\Policies;

use App\Enrollment;
use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnrollmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any enrollments.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can view the enrollment.
     *
     * @param \App\User $user
     * @param \App\Enrollment $enrollment
     * @return mixed
     */
    public function view(User $user, Enrollment $enrollment)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can create enrollments.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can update the enrollment.
     *
     * @param \App\User $user
     * @param \App\Enrollment $enrollment
     * @return mixed
     */
    public function update(User $user, Enrollment $enrollment)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can delete the enrollment.
     *
     * @param \App\User $user
     * @param \App\Enrollment $enrollment
     * @return mixed
     */
    public function delete(User $user, Enrollment $enrollment)
    {
        return $user->role_slug == Role::$DIRECTOR || $user->role_slug == Role::$SECRETARY;
    }

    /**
     * Determine whether the user can restore the enrollment.
     *
     * @param \App\User $user
     * @param \App\Enrollment $enrollment
     * @return mixed
     */
    public function restore(User $user, Enrollment $enrollment)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the enrollment.
     *
     * @param \App\User $user
     * @param \App\Enrollment $enrollment
     * @return mixed
     */
    public function forceDelete(User $user, Enrollment $enrollment)
    {
        return false;
    }
}
