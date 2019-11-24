<?php

namespace App\Policies;

use App\Classroom;
use App\ClassroomDisciplineUser;
use App\Discipline;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomDisciplineUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any classroom discipline users.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny', Classroom::class) &&
            $user->can('viewAny', Discipline::class) &&
            $user->can('viewAny', User::class);
    }

    /**
     * Determine whether the user can view the classroom discipline user.
     *
     * @param \App\User $user
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return mixed
     */
    public function view(User $user, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        return $user->can('view', $classroomDisciplineUser->classroom) &&
            $user->can('view', $classroomDisciplineUser->discipline) &&
            $user->can('view', $classroomDisciplineUser->user);
    }

    /**
     * Determine whether the user can create classroom discipline users.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create', Classroom::class) &&
            $user->can('create', Discipline::class) &&
            $user->can('create', User::class);
    }

    /**
     * Determine whether the user can update the classroom discipline user.
     *
     * @param \App\User $user
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return mixed
     */
    public function update(User $user, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        return $user->can('update', $classroomDisciplineUser->classroom) &&
            $user->can('update', $classroomDisciplineUser->discipline) &&
            $user->can('update', $classroomDisciplineUser->user);
    }

    /**
     * Determine whether the user can delete the classroom discipline user.
     *
     * @param \App\User $user
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return mixed
     */
    public function delete(User $user, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the classroom discipline user.
     *
     * @param \App\User $user
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return mixed
     */
    public function restore(User $user, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the classroom discipline user.
     *
     * @param \App\User $user
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return mixed
     */
    public function forceDelete(User $user, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        return false;
    }
}
