<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMenu extends Model
{
	protected $table = 'categories_menus';

    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'name', 'colour','created_by', 'updated_by', 'deleted_by'];    

    protected $hidden = ['id', 'cafe_id', 'created_by', 'updated_by', 'deleted_by'];

    //RELATIONS
    public function menus()
    {
    	return $this->hasMany(Menu::class);
    }
    
    public function cafe()
    {
    	return $this->belongsTo(Cafe::class);
    }

}
