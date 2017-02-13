<?php

namespace App;

use App\models\City;
use App\models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CafeBranch extends Model
{
    use SoftDeletes;

    public $incrementing = FALSE;

    protected $fillable = ['id', 'cafe_id', 'location_id', 'address', 'phone', 'open_hours', 'close_hours'];
    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

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


    /**
     * Get Location Name by ID Location and Length of ID that determine location type.
     *
     * @param $branch
     * @param Indonesia $indonesia
     */
    public static function get_location($branch, Indonesia $indonesia)
    {
        $locationLength = strlen($branch->location_id);
        switch ($locationLength) {
            case 2:
                $branch->location = $indonesia->findProvince($branch->location_id);
                break;
            case 4:
                $branch->location = $indonesia->findCity($branch->location_id, ['province']);
                break;
            case 7:
                $branch->location = $indonesia->findDistrict($branch->location_id, ['city', 'province']);
                break;
        }
    }

    /**
     * Set Location ID by the last location selected. Left to Right Priority province_id|city_id|district_id.
     *
     * @param Request $request
     * @return Location ID
     */
    public static function set_location_id(Request $request)
    {
        $location_id = $request->province_id;
        if ($request->city_id) {
            $location_id = $request->city_id;
        }
        if ($request->district_id) {
            $location_id = $request->district_id;
            return $location_id;
        }
        return $location_id;
    }

}
