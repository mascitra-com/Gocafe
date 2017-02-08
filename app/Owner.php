<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Owner extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $dates = ['deleted_at'];

    protected $guarded = ['user_id', 'created_by'];

    protected $hidden = ['id'];

    /**
     * Get Owner ID by User ID currently logged in
     *
     * @return mixed
     */
    public static function getOwnerIdNowLoggedIn()
    {
        return DB::table('owners')->where('user_id', Auth::user()->id)->first()->id;
    }

    /**
     * Set Profile Cafe with Owner ID given in the parameter
     *
     * @param Cafe $cafe
     * @param $owner_id
     */
    public function addProfileCafe(Cafe $cafe, $owner_id)
    {
        $cafe->id = idWithPrefix(4);
        $cafe->created_by = Auth::user()->id;
        Owner::find($owner_id)->cafe()->save($cafe);
    }

    /**
     * Get Cafe by Owner ID given in the parameter.
     *
     * @param $id
     * @return mixed
     */
    public function getCafeByOwnerId($id)
    {
        return $this->findOrFail($id)->cafe->firstOrFail();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafe()
    {
        return $this->hasOne(Cafe::class);
    }

    public function branches()
    {
        return $this->hasManyThrough(CafeBranch::class, Cafe::class);
    }
}
