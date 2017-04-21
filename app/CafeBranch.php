<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CafeBranch extends Model
{
    use SoftDeletes;

    public $incrementing = FALSE;

    protected $fillable = ['id', 'cafe_id', 'location_id', 'address', 'phone', 'open_hours', 'close_hours', 'number_of_tables'];
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public static function getNumberOfTablesByStaffNowLoggedIn()
    {
        $cafeBranchId = Staff::getCafeBranchIdNowLoggedIn();
        return DB::table('cafe_branches')->where('id', $cafeBranchId)->first()->number_of_tables;
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

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
