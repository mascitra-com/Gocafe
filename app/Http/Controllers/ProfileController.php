<?php

namespace App\Http\Controllers;

use App\Foo;
use App\Owner;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProfileController untuk Fitur Owner Profile
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function edit(User $user)
    {
        $role = $user->get_role(Auth::user()->id);

        if ($role === 'owner') {
            $profile = User::find(Auth::user()->id)->owner;
            if($profile) {
                $user = User::find(Auth::user()->id);
                $avatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($user->avatar_name));
            }
            return view('owner.owner_profile', compact('profile', 'avatar'));
        } elseif ($role === 'staff') {
            return 'ambil profil staff (progress)';
        } else {
            return 'error';
        }
    }

    public function updatePersonal(Request $request, $id)
    {
        $birthdate = frmtPartDate($request->birthdate_day, $request->birthdate_month, $request->birthdate_year);
        $request->merge(array('birthdate' => $birthdate));
        $input = $request->except('birthdate_year', 'birthdate_month', 'birthdate_day');
        Owner::findOrFail($id)->update($input);
        return redirect('profile');
    }

    public function updateContact(Request $request, $id)
    {
        Owner::findOrFail($id)->update($request->all());
        return redirect('profile');
    }

    public function updateAvatar(Request $request, $id)
    {
        //checking file is present
        if ($request->hasFile('avatar')) {
            //verify the file is uploading
            if ($request->file('avatar')->isValid()) {
                //store to storage/app/owner
                $path = $request->file('avatar')->store('owner', 'owner');
                //update avatar_ users table
                $input = array(
                    'avatar_name' => $path,
                );
                $request->merge($input);
                $user = User::findOrFail(decrypt($id));
                if($exists = Storage::disk('owner')->exists($user->avatar_name))
                    Storage::delete("public/$user->avatar_name");
                $user->update($request->except('avatar'));
                return response()->json(['response' => 'sukses', 'status' => TRUE]);
            } else {
                return response()->json(['response' => 'gagal upload', 'status' => FALSE]);
            }
        } else {
            return response()->json(['response' => 'file kosong', 'status' => FALSE]);
        }
    }
}
