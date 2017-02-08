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


    public function addProfileCafe(Cafe $cafe, $owner_id)
    {
        $cafe->id = $cafe->getNewId();
        $cafe->created_by = Auth::user()->id;
        Owner::find($owner_id)->cafe()->save($cafe);
    }

    public static function getOwnerIdNowLoggedIn()
    {
        return DB::table('owners')->where('user_id', Auth::user()->id)->first()->id;
    }

    public function getCafeByOwnerId($id)
    {
        return $this->findOrFail($id)->cafe->firstOrFail();
    }

    //RELATIONS
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
