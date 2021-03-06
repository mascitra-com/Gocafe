<?php

namespace App\Policies;

use App\Cafe;
use App\CafeBranch;
use App\Owner;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given cafe branch can be updated by the user.
     *
     * @param  \App\User $user
     * @param $id
     * @return bool
     */
    public function update(User $user, $id)
    {
        $branch = CafeBranch::findOrfail($id);
        $cafe = Cafe::findOrFail($branch->cafe_id);
        $owner = Owner::findOrfail($cafe->owner_id);
        return $user->id == $owner->user_id;
    }
}
