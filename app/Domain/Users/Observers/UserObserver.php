<?php


namespace App\Domain\Users\Observers;


use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the Job "creating" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->id = Str::uuid();
        $user->password = Hash::make($user->password);
    }
}
