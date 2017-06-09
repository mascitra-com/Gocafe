<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    use SoftDeletes;

    protected $table = 'information';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'type', 'title', 'link', 'body', 'part', 'created_by'];
}
