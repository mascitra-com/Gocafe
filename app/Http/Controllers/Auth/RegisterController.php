<?php

namespace App\Http\Controllers\Auth;

use App\Owner;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'last_name' => 'max:255',
            'phone' => 'required|max:14',
            'gender' => 'required|',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'owner',
            'avatar_name' => 'default.jpg',
            'avatar_mime' => 'image/jpeg'
        ]);
        Owner::create([
            'id' => idWithPrefix(1),
            'user_id' => $user->id,
            'first_name' => $data['name'],
            'last_name' => $data['last_name'] != NULL ? $data['last_name'] : '',
            'phone' => $data['phone'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'created_by' => 0
        ]);
        return $user;
    }
}
