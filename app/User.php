<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar_name','avatar_mime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function get_role($id)
    {
        return $this->findOrFail($id)->first()->role;
    }

    public function getAvatar($id, $disk, $path)
    {
        $entry = $this->findOrFail($id)->firstOrFail();

        $avatar = Storage::disk($disk)->get($path.'/'.$entry->avatar_name);
 
        return array($entry, $avatar);
    }

    public function getOwnerByUserId($id)
    {
        return $this->findOrFail($id)->owner->firstOrFail();
    }
    
    //RELATIONS
    public function owner()
    {
       return $this->hasOne(Owner::class);
    }

    public function staff()
    {
       return $this->hasOne(Staff::class);
    }

}
