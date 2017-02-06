<?php

namespace App;

use App\models\City;
use App\models\Province;
use Illuminate\Database\Eloquent\Model;

class CafeBranch extends Model
{
    public $incrementing = FALSE;
    protected $guarded = ['created_by'];

    protected $fillable = ['id', 'cafe_id', 'city_id', 'province_id', 'address', 'phone', 'open_hours', 'close_hours'];

    public function city()
    {
        return $this->hasOne(City::class, 'city_id', 'city_id');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'province_id', 'province_id');
    }

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function getNewId()
    {
        return 'CFB' . random_int(100, 999) . date('Ymdhis');
    }
}
