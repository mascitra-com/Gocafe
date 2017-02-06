<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staffs';

	public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'user_id', 'position_id', 'branch_id','gender', 'birthdate', 'first_name', 'last_name', 'address','phone', 'created_by'];    

    protected $hidden = ['id', 'user_id', 'position_id', 'branch_id', 'created_by', 'updated_by', 'deleted_by'];

    //RELATIONS
    public function position()
    {
    	return $this->belongsToMany(Position::class);
    }
    
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
    
    public function branch()
    {
    	return $this->belongsTo(Branch::class, 'branch_id');
    }

}
