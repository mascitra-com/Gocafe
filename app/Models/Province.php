<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\CafeBranch;

class Province extends Model
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
    protected $primaryKey = 'province_id';

    public function __construct()
    {
        $this->table = config('laraciproid.province');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\City','province_id');
    }

    public function cafeBranch()
    {
        return $this->belongsToMany(CafeBranch::class);
    }
}
