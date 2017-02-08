<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cafe extends Model
{
    public $incrementing = FALSE;

    protected $fillable = ['id', 'owner_id', 'name', 'description', 'open_hours', 'close_hours', 'phone', 'facebook', 'twitter', 'instagram'];

    //RELATIONS
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function branch()
    {
        return $this->hasMany(CafeBranch::class);
    }

    public function staffs()
    {
        return $this->hasManyThrough(Staff::class, CafeBranch::class, 'cafe_id', 'branch_id', 'id');
    }

    public function positions()
    {
        return $this->hasManyThrough(Position::class, CafeBranch::class, 'cafe_id', 'branch_id', 'id');
    }

    public function getNewId()
    {
        return 'CAF'.random_int(100, 999).date('Ymdhis');
    }

    public function addBranch(CafeBranch $cafeBranch, $cafeId)
    {
        $cafeBranch->id = $cafeBranch->getNewId();
        $cafeBranch->created_by = Auth::user()->id;
        self::find($cafeId)->branch()->save($cafeBranch);
    }

    public static function getCafeIdByOwnerIdNowLoggedIn()
    {
        $cafe = DB::table('cafes')->where('owner_id', Owner::getOwnerIdNowLoggedIn())->first();
        if($cafe){
            return $cafe->id;
        } else {
            return NULL;
        }
    }

}
