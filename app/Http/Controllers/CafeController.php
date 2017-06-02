<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

/**
 * Class CafeController untuk Fitur Profile (Cafe)
 * @package App\Http\Controllers
 */
class CafeController extends Controller
{

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
     * @param $id
     * @param Cafe $cafe
     * @return $this
     */
    public function showLogo($id, Cafe $cafe)
    {
        $logo_instance = $cafe->getLogo($id, 'logo', 'logo');
        return (new Response($logo_instance[1], 200))->header('Content-Type', $logo_instance[0]->mime);
    }

    public function updateLogo(Request $request, $id)
    {
        //checking file is present
        if ($request->hasFile('logo')) {
            //verify the file is uploading
            if ($request->file('logo')->isValid()) {
                $logo_name = idWithPrefix(12);
                $logo_mime = $request->logo->getClientMimeType();
                //store to storage/app/owner
                $request->logo->storeAs('logo', $logo_name, 'logo');
                //update avatar_ users table
                $input = array(
                    'logo_name' => $logo_name,
                    'logo_mime' => $logo_mime,
                );
                $request->merge($input);
                Cafe::findOrFail($id)->update($request->except('logo'));
                return response()->json(['response' => 'sukses', 'logo' => $logo_name, 'mime' => $logo_mime, 'status' => TRUE]);
            } else {
                return response()->json(['response' => 'gagal upload', 'status' => FALSE]);
            }
        } else {
            return response()->json(['response' => 'file kosong', 'status' => FALSE]);
        }
    }

    public function updateLogoName(Request $request)
    {
//        User::findOrFail(1)->update($request->all());
        return response()->json(['response' => 'sukses', 'status' => TRUE]);
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
