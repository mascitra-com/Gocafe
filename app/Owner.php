<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Auth;

class Owner extends Model
{

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function editProfileCafe(Cafe $cafe_profile)
    {
        $cafe->owner_id = Auth::user->id;
        $this->cafe->save($cafe_profile);
    }
}
