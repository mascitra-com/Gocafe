<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'category_id', 'name', 'description', 'price','images_name','mime','status','created_by', 'updated_by', 'deleted_by', 'discount'];    

    protected $hidden = ['id', 'cafe_id', 'category_id', 'created_by', 'updated_by', 'deleted_by'];

    public function getImages($id, $disk, $path)
    {
        $entry = $this->findOrFail($id);

        $images = Storage::disk($disk)->get($path.'/'.$entry->images_name);
 
        return array($entry, $images);
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
