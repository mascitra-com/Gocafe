<?php

namespace App\Http\Controllers;

use App\Foo;
use App\Owner;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProfileController untuk Fitur Owner Profile
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    /**
     * @param User $user
     * @return $this
     */
    public function showAvatar(User $user)
    {
        $avatar_instance = $user->getAvatar(Auth::user()->id, 'owner', 'owner');
        return (new Response($avatar_instance[1], 200))->header('Content-Type', $avatar_instance[0]->mime);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function edit(User $user)
    {
        $role = $user->get_role(Auth::user()->id);

        if ($role === 'owner') {
            $profile = User::find(Auth::user()->id)->owner;
            return view('owner.owner_profile', compact('profile'));
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
                $avatar_name = idWithPrefix(3);
                $avatar_mime = $request->avatar->getClientMimeType();
                //store to storage/app/owner
                $request->avatar->storeAs('owner', $avatar_name, 'owner');
                //update avatar_ users table
                $input = array(
                    'avatar_name' => $avatar_name,
                    'avatar_mime' => $avatar_mime,
                );
                $request->merge($input);
                User::findOrFail(decrypt($id))->update($request->except('avatar'));
                return response()->json(['response' => 'sukses', 'avatar_name' => $avatar_name, 'avatar_mime' => $avatar_mime, 'status' => TRUE]);
            } else {
                return response()->json(['response' => 'gagal upload', 'status' => FALSE]);
            }
        } else {
            return response()->json(['response' => 'file kosong', 'status' => FALSE]);
        }
    }

    public function updateAvatarName(Request $request)
    {
        User::findOrFail(1)->update($request->all());
        return response()->json(['response' => 'sukses', 'status' => TRUE]);
    }
}
