<?php

namespace App\Policies;

use App\Cafe;
use App\Owner;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CafeProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given cafe profile data can be stored by the user.
     *
     * @param  \App\User $user
     * @param Owner $owner
     * @return bool
     */
    public function store(User $user, Owner $owner)
    {
        return $user->id == $owner->user_id;
    }

    /**
     * Determine if the given cafe profile can be updated by the user.
     *
     * @param  \App\User $user
     * @param $id
     * @return bool
     */
    public function update(User $user, $id)
    {
        $cafe = Cafe::findOrFail($id);
        $owner = Owner::findOrfail($cafe->owner_id);
        return $user->id == $owner->user_id;
    }
}
