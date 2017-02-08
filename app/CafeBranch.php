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
        return $this->hasMany(Staff::class);
    }

    public function getNewId() // TODO Delete this soon after using helper
    {
        return 'CFB' . random_int(100, 999) . date('Ymdhis');
    }
}
