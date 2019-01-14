<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class CafeBranch extends Model
{
    use SoftDeletes;

    public $incrementing = FALSE;

    protected $fillable = ['id', 'cafe_id', 'address', 'phone', 'open_hours', 'close_hours', 'number_of_tables', 'status', 'google_maps', 'province_id', 'city_id', 'district_id'];
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public static function getNumberOfTablesByStaffNowLoggedIn()
    {
        $cafeBranchId = Staff::getCafeBranchIdNowLoggedIn();
        return DB::table('cafe_branches')->where('id', $cafeBranchId)->first()->number_of_tables;
    }

    public static function getBranchIdsByUserNowLoggedIn()
    {
        $branches = CafeBranch::all()->where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn());
        return $branches->map(function ($branch) {
            return collect($branch->toArray())
                ->only(['id'])
                ->all();
        })->toArray();
    }

    public static function getBranchIdByUserNowLoggedIn()
    {
        return CafeBranch::where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn())->first()->id;
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

    public function district()
    {
        return $this->belongsTo(District::class);
	}

    public function city()
    {
        return $this->belongsTo(City::class);
	}

    public function province()
    {
        return $this->belongsTo(Province::class);
	}

}
