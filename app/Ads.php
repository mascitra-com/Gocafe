<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ads extends Model
{
    protected $table = "ads";

    protected $fillable = ['title', 'description', 'banner', 'banner_mime', 'page', 'created_by'];


    public function getBanner($id, $disk, $path)
    {
        $entry = Ads::find($id);
        $banner = Storage::disk($disk)->get($path.'/'.$entry->banner);
        return array($banner, $entry->banner_mime);
    }
}
