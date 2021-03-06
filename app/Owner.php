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

    protected $guarded = ['created_at'];

    protected $hidden = ['id'];

    /**
     * Get Owner ID by User ID currently logged in
     *
     * @return Owner ID
     */
    public static function getOwnerIdNowLoggedIn()
    {
        return DB::table('owners')->where('user_id', Auth::user()->id)->first()->id;
    }


	/**
	 * Get Cafe Branch ID by Staff ID currently logged in
	 *
	 * @return Owner ID
	 */
	public static function getCafeIdByOwnerIdNowLoggedIn()
	{
		return DB::table('cafes')->where('owner_id', Owner::getOwnerIdNowLoggedIn())->first()->id;
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
     * @return Cafe Object
     */
    public function getCafeByOwnerId($id)
    {
        return $this->findOrFail($id)->cafe();
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
