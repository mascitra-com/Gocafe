<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
        $shop_cat = DB::table('shop_category')->get();
        if($cafe) {
            $logo = str_replace('storage/logo/', 'img/cache/small-logo/', Storage::url($cafe->logo_path));
            $cover = str_replace('storage/cover/', 'img/cache/small-cover/', Storage::url($cafe->cover_path));
        }
        return view('cafe.profile', compact('cafe', 'logo', 'cover', 'shop_cat'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateLogo(Request $request, $id)
    {
        //checking file is present
        if ($request->hasFile('logo')) {
            //verify the file is uploading
            if ($request->file('logo')->isValid()) {
                $path = $request->file('logo')->store('logo', 'logo');
                $input = array(
                    'logo_path' => $path,
                );
                $request->merge($input);
                $cafe = Cafe::findOrFail($id);
                if($exists = Storage::disk('logo')->exists($cafe->logo_path))
                    Storage::delete("public/$cafe->logo_path");
                $cafe->update($request->except('logo'));
                return response()->json(['response' => 'sukses', 'status' => 'Logo Berhasil di simpan']);
            } else {
                return response()->json(['response' => 'gagal upload', 'status' => FALSE]);
            }
        } else {
            return response()->json(['response' => 'file kosong', 'status' => FALSE]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateCover(Request $request, $id)
    {
        //checking file is present
        if ($request->hasFile('cover')) {
            //verify the file is uploading
            if ($request->file('cover')->isValid()) {
                $path = $request->file('cover')->store('cover', 'cover');
                $input = array(
                    'cover_path' => $path,
                );
                $request->merge($input);
                $cafe = Cafe::findOrFail($id);
                if($exists = Storage::disk('cover')->exists($cafe->cover_path))
                Storage::delete("public/$cafe->cover_path");
                $cafe->update($request->except('cover'));
                return response()->json(['response' => 'sukses', 'status' => 'Cover Berhasil di simpan']);
            } else {
                return response()->json(['response' => 'gagal upload', 'status' => FALSE]);
            }
        } else {
            return response()->json(['response' => 'file kosong', 'status' => FALSE]);
        }
    }

    /**
     * Store a newly Cafe Profile.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Owner $owner
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Owner $owner)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'shop_category_id' => 'required',
            'description' => 'min:3|required',
            'phone' => 'max:20',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'instagram' => 'max:255',
        ]);
        $request->request->add([
            'slug' => str_slug($request->name, '-')
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
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'shop_category_id' => 'required',
            'description' => 'min:3|required',
        ]);
        if(!isset($request->status)) {
	        $request->request->add([
		        'status' => 'off'
	        ]);
        }
        $request->request->add([
            'slug' => str_slug($request->name, '-')
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
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
