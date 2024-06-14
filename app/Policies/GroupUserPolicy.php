<?php

namespace App\Policies;

use App\Models\HumanResources\User;
use App\Models\group_user;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @param  \App\Models\group_user  $groupUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, group_user $groupUser)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @param  \App\Models\group_user  $groupUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, group_user $groupUser)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @param  \App\Models\group_user  $groupUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, group_user $groupUser)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @param  \App\Models\group_user  $groupUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, group_user $groupUser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\HumanResources\User  $user
     * @param  \App\Models\group_user  $groupUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, group_user $groupUser)
    {
        //
    }
}
