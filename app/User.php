<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
