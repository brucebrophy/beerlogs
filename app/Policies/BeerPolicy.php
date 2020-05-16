<?php

namespace App\Policies;

use App\User;
use App\Beers\Beer;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beers\Beer  $beer
     * @return mixed
     */
    public function view(User $user, Beer $beer)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beers\Beer  $beer
     * @return mixed
     */
    public function update(User $user, Beer $beer)
    {
        return $user->id === (int) $beer->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beers\Beer  $beer
     * @return mixed
     */
    public function delete(User $user, Beer $beer)
    {
        return $user->id === (int) $beer->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beers\Beer  $beer
     * @return mixed
     */
    public function restore(User $user, Beer $beer)
    {
        return $user->id === (int) $beer->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Beers\Beer  $beer
     * @return mixed
     */
    public function forceDelete(User $user, Beer $beer)
    {
        return $user->id === (int) $beer->user_id;
    }
}
