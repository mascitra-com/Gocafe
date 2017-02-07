<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foo extends Model
{

    protected $fillable = ['filename', 'mime', 'original_filename', 'user_id'];
    protected $hidden = ['id' ,'user_id'];
}
