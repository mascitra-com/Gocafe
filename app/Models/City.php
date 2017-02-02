<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\CafeBranch;

class City extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = FALSE;

    /**
     * Indicates if the model primary key.
     *
     * @var bool
     */
    protected $primaryKey = 'city_id';

    public function __construct()
    {
        $this->table = config('laraciproid.city');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province','province_id');
    }

    public function cafeBranch()
    {
        return $this->belongsToMany(CafeBranch::class, 'city_id', 'city_id');
    }

}
