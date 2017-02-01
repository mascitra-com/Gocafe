<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CafeProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display Cafe Profile by owner id now logged in.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = new Owner();
        $cafe = DB::table('cafes')->where('owner_id', $owner->getOwnerIdByUserIdNowLoggedIn())->first();
        return view('cafe.profile', compact('cafe'));
    }

    /**
     * Store a newly Cafe Profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Owner $owner)
    {
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'description' => 'min:3|required',
            'phone' => 'max:20',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'instagram' => 'max:255',
        ]);
        $owner->id = $owner->getOwnerIdByUserIdNowLoggedIn();
        $cafe = new Cafe($request->all());
        $owner->addProfileCafe($cafe);
        return redirect('profile/cafe')->with('status', 'Profile updated!');
    }

    /**
     * Update the Cafe Profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'description' => 'min:3|required',
        ]);
        $cafe = Cafe::find($id);
        $cafe->update($request->all());
        return redirect('profile/cafe')->with('status', 'Basic Info updated!');
    }

    /**
     * Update the Contact Info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => 'max:20',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'instagram' => 'max:255',
        ]);
        $cafe = Cafe::find($id);
        $cafe->update($request->all());
        return redirect('profile/cafe')->with('status', 'Contact Info updated!');
    }

}
