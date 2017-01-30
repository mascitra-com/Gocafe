<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
