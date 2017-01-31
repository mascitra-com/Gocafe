<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    public $incrementing = FALSE;

    protected $fillable = ['id', 'owner_id', 'name', 'description', 'open_hours', 'close_hours', 'phone', 'facebook', 'twitter', 'instagram'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function getNewId()
    {
        return 'CAF'.random_int(100, 999).date('Ymdhis');
    }

}
