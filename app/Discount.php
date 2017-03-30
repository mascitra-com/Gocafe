<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes;

    protected $table = 'discounts';

    public $incrementing = false;

	protected $dates = ['deleted_at'];

	protected $fillable = ['id', 'cafe_id', 'name', 'description', 'start_date','expired_date', 'value', 'created_by'];

	protected $hidden = ['id', 'created_by', 'updated_by', 'deleted_by'];

    //RELATIONS
    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }
}
