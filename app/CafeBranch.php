<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CafeBranch extends Model
{
    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

	protected $guarded= ['id'];

	public function cafe()
	{
		return $this->belongsTo(Cafe::class);
	}

	public function staffs()
	{
		return $this->hasMany(Staff::class, 'branch_id');
	}

	public function positions()
	{
		return $this->hasMany(Position::class, 'branch_id');
	}
}
