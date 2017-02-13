<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMenu extends Model
{
    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'name', 'colour','created_by', 'updated_by', 'deleted_by'];    

    protected $hidden = ['id', 'cafe_id', 'created_by', 'updated_by', 'deleted_by'];

    //RELATIONS
    public function cafe()
    {
    	return $this->belongsTo(Cafe::class);
    }
}
