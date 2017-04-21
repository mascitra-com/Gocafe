<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'category_id', 'name', 'description', 'price','images_name','mime','status','created_by', 'updated_by', 'deleted_by', 'discount'];    

    protected $hidden = ['cafe_id', 'category_id', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * Get One Image from Menu
     *
     * @param $id
     * @param $disk
     * @param $path
     * @return array
     */
    public function getThumbnail($id, $disk, $path)
    {
        $menu = $this->findOrFail($id)->attributes;
        $images = explode(':', $menu['images_name']);
        $mimes = explode(':', $menu['mime']);
        $thumb = 'default';
        $mime = 'jpeg:image';
        foreach ($images as $key => $image){
            if($image !== 'default'){
                $thumb = $image;
                $mime = $mimes[$key];
                break;
            }
        }
        $thumbnail = Storage::disk($disk)->get($path.'/'.$thumb);
        return array($thumbnail, $mime);
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
        return $this->belongsToMany(Package::class)->withTimestamps();;
    }
}
