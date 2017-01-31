<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $fillable = ['id', 'name', 'description', 'open_hours', 'close_hours'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
