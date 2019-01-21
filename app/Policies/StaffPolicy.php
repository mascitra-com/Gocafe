<?php

namespace App\Policies;

use App\Cafe;
use App\CafeBranch;
use App\Owner;
use App\Staff;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class StaffPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given staff can be stored by the user.
     *
     * @param User $user
     * @param Request $request
     * @return bool
     */
    public function create(User $user, Request $request)
    {
        $owner = Owner::select('id')->where('user_id', $user->id)->first();
        $cafe = Cafe::select('id')->where('owner_id', $owner->id)->first();
        if(CafeBranch::select('id')->where(['id' => $request->branch_id, 'cafe_id' => $cafe->id])->count())
            return true;
        else
            return false;
    }

    /**
     * Determine if the given staff can be updated by the user.
     *
     * @param User $user
     * @param Staff $staff
     * @return bool
     */
    public function update(User $user, Staff $staff)
    {
        $owner = Owner::select('id')->where('user_id', $user->id)->first();
        $cafe = Cafe::select('id')->where('owner_id', $owner->id)->first();
        if(CafeBranch::select('id')->where(['id' => $staff->branch_id, 'cafe_id' => $cafe->id])->count())
            return true;
        else
            return false;
    }
}
