<?php

namespace App\Users\Policies;

use App\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $loggedUser
     * @param User $user
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function disable(User $loggedUser, User $user)
    {
        if ($loggedUser->id === $user->id) {
            $this->deny('You can not disable yourself');
        }

        return true;
    }

    /**
     * @param User $loggedUser
     * @param User $user
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $loggedUser, User $user)
    {
        if ($loggedUser->id === $user->id) {
            $this->deny('You can not remove yourself');
        }

        return true;
    }
}
