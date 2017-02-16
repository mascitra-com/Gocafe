<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'category_id', 'name', 'description', 'price','images_name','mime','status','created_by', 'updated_by', 'deleted_by'];    

    protected $hidden = ['id', 'cafe_id', 'category_id', 'created_by', 'updated_by', 'deleted_by'];

    //RELATIONS
    public function cafe()
    {
    	return $this->belongsTo(Cafe::class);
    }

    public function category()
    {
    	return $this->belongsTo(CategoryMenu::class);
    }
}
