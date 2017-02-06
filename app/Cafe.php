<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    public $incrementing = FALSE;

    protected $fillable = ['id', 'owner_id', 'name', 'description', 'open_hours', 'close_hours', 'phone', 'facebook', 'twitter', 'instagram'];

    //RELATIONS
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function branches()
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

}
