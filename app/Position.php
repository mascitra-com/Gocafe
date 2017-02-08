<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

	//RELATIONS
	
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function staff()
    {
    	return $this->hasMany(Staff::class);
    }

	public function branches()
    {
    	return $this->belongsTo(CafeBranch::class, 'branch_id');
    }
}
