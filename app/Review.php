<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = ['item_id', 'rating', 'review', 'created_by'];

    protected $dates = ['deleted_at'];

    protected $table = 'reviews';

    public function menus()
    {
        return $this->belongsTo(Menu::class);
    }

    public function packages()
    {
        return $this->belongsTo(Package::class);
    }
}
