<?php

namespace App;

use App\models\City;
use App\models\Province;
use Illuminate\Database\Eloquent\Model;

class CafeBranch extends Model
{
    public $incrementing = FALSE;
    protected $guarded = ['created_by'];

    protected $fillable = ['id', 'cafe_id', 'location_id', 'address', 'phone', 'open_hours', 'close_hours'];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function getNewId()
    {
        return 'CFB' . random_int(100, 999) . date('Ymdhis');
    }
}
