<?php

namespace App\Policies;

use App\Owner;
use App\Staff;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User $user
     * @param $id
     * @return bool
     */
    public function update(User $user, $id)
    {
        if(Auth::user()->role == 'owner'){
            $owner = Owner::findOrFail($id)->first();
            return $user->id == $owner->user_id;
        } elseif(Auth::user()->role == 'owner'){
            $staff = Staff::findOrFail($id)->first();
            return $user->id == $staff->user_id;
        } else {
            return false;
        }
    }
}
