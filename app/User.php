<?php

namespace App;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Auth;
use Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Messagable;

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
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * @param User $user
     * @param $password
     * @param $role
     * @return mixed
     */
    public function addUser(User $user, $password, $role)
    {
        $user->password = bcrypt($password);
        $user->role = $role;
        $this->save();
        return $user->id;
    }

    public function get_role($id)
    {
        return $this->findOrFail($id)->role;
    }

    public function getAvatar($id, $disk, $path)
    {
        $entry = $this->findOrFail($id)->firstOrFail();

        $avatar = Storage::disk($disk)->get($path.'/'.$entry->avatar_name);
 
        return array($entry, $avatar);
    }

    public function getAccountByUserId($id)
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

    public function has_role($role)
    {
        return Auth::user()->role == $role;
    }

}
