<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'category_id', 'name', 'description', 'cost', 'price','images','status','created_by', 'updated_by', 'deleted_by', 'discount', 'halal'];

    protected $hidden = ['cafe_id', 'category_id', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * Get One Image from Menu
     *
     * @param $id
     * @return array
     */
    public static function getThumbnail($id)
    {
        $menu =  parent::findOrFail($id)->attributes;
        $images = explode(':', $menu['images']);
        $thumb = '/storage/default';
        foreach ($images as $key => $image){
            if($image !== 'default'){
                $thumb = $image;
                break;
            }
        }
        $thumbnail = Storage::disk('product')->url($thumb);
        return array($thumbnail);
    }

    //RELATIONS
    public function cafe()
    {
    	return $this->belongsTo(Cafe::class);
    }

    public function category()
    {
    	return $this->belongsTo(CategoryMenu::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withTimestamps();
    }

    public function cartitem()
    {
        return $this->morphMany('CartItems', 'cartable');
    }
}
