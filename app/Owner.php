<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Owner extends Model
{
    public $incrementing = FALSE;

    public function cafe()
    {
        return $this->hasOne(Cafe::class);
    }

    public function addProfileCafe(Cafe $cafe_profile)
    {
        $cafe_profile->id = $cafe_profile->getNewId();
        $cafe_profile->created_by = 1;
        $this->cafe()->save($cafe_profile);
    }

    public function getOwnerIdByUserIdNowLoggedIn()
    {
        return 'OWN02131321';
    }

}
