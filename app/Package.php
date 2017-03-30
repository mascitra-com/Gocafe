<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Package extends Model
{
	use SoftDeletes;

	public $incrementing = false;

	protected $dates = ['deleted_at'];

	protected $fillable = ['id', 'name', 'description', 'price','images_name','mime', 'created_by', 'updated_by', 'deleted_by', 'discount'];    

	protected $hidden = ['id', 'created_by', 'updated_by', 'deleted_by'];

	public function getImage($id, $disk, $path)
    {
        $entry = $this->findOrFail($id)->firstOrFail();

        $avatar = Storage::disk($disk)->get($path.'/'.$entry->images_name);
 
        return array($entry, $avatar);
    }

    //RELATIONS
	public function menus()
	{
		return $this->belongsToMany(Menu::class)->withTimestamps();;
	}
}
