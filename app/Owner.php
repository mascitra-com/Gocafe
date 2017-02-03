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

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function cafe()
    {
        return $this->hasOne(Cafe::class);
    }

    public function addProfileCafe(Cafe $cafe)
    {
        $cafe->id = $cafe->getNewId();
        $cafe->created_by = Auth::user()->id;
        $this->cafe()->save($cafe);
    }

    public function addBranch(CafeBranch $cafeBranch)
    {
        $cafeBranch->id = $cafeBranch->getNewId();
        $cafeBranch->cafe_id = $this->getCafeIdByOwnerIdNowLoggedIn();
        $cafeBranch->created_by = Auth::user()->id;
        $this->cafe()->save($cafeBranch);
    }

    public function getOwnerIdByUserIdNowLoggedIn()
    {
        return DB::table('owners')->where('user_id', Auth::user()->id)->first()->id;
    }

    public function getCafeIdByOwnerIdNowLoggedIn()
    {
        $cafe = DB::table('cafes')->where('owner_id', $this->getOwnerIdByUserIdNowLoggedIn())->first();
        if($cafe){
            return $cafe->id;
        } else {
            return NULL;
        }
    }

}
