<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CafeController untuk Fitur Profile (Cafe)
 * @package App\Http\Controllers
 */
class CafeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
        // Show Profile Cafe with Owner ID currently logged in
        $cafe = DB::table('cafes')->where('owner_id', Owner::getOwnerIdNowLoggedIn())->first();
        return view('cafe.profile', compact('cafe'));
    }

    /**
     * Store a newly Cafe Profile.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Owner $owner)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'description' => 'min:3|required',
            'phone' => 'max:20',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'instagram' => 'max:255',
        ]);
        // Add Profile Cafe with Owner ID currently logged in
        $cafe = new Cafe($request->all());
        $owner->addProfileCafe($cafe, Owner::getOwnerIdNowLoggedIn());
        return redirect('profile/cafe')->with('status', 'Profile updated!');
    }

    /**
     * Update the Cafe Profile.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'description' => 'min:3|required',
        ]);
        Cafe::findOrFail($id)->update($request->all());
        return redirect('profile/cafe')->with('status', 'Basic Info updated!');
    }

    /**
     * Update the Contact Info.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request, $id)
    {
        // Validate the required data
        $this->validate($request, [
            'phone' => 'max:20',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'instagram' => 'max:255',
        ]);
        Cafe::findOrFail($id)->update($request->all());
        return redirect('profile/cafe')->with('status', 'Contact Info updated!');
    }

}
