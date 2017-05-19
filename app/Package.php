<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Package extends Model
{
	public $incrementing = false;

	protected $dates = ['deleted_at'];

	protected $fillable = ['id', 'cafe_id' ,'name', 'description', 'price','images_name','mime', 'created_by', 'updated_by', 'deleted_by', 'discount'];    

	protected $hidden = ['created_by', 'updated_by', 'deleted_by'];

	public function getImage($id, $disk, $path)
	{
		$entry = $this->findOrFail($id);

		$avatar = Storage::disk($disk)->get($path.'/'.$entry->images_name);

		return array($entry, $avatar);
	}

    //RELATIONS
	public function menus()
	{
		return $this->belongsToMany(Menu::class)->withTimestamps();;
	}
}
