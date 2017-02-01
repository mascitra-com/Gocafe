<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;
use Auth;

use App\Foo;

use Illuminate\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfileController extends Controller
{
	public function showAvatar(User $user)
	{
		$avatar_instance = $user->getAvatar(Auth::user()->id, 'owner', 'owner');

		return (new Response($avatar_instance[1], 200))
              ->header('Content-Type', $avatar_instance[0]->mime);
	}

	public function edit(User $user)
	{
		$role = $user->get_role(Auth::user()->id);

		if ($role === 'owner') {
			$profile = User::find(Auth::user()->id)->owner;
			return view('owner.owner_profile', compact('profile'));
		}elseif ($role === 'staff') {
			return 'ambil profil staff (progress)';
		}else{
			return 'error';
		}
	}

	public function updatePersonal(Request $request ,$id)
	{	
		$birthdate = frmtPartDate($request->birthdate_day, $request->birthdate_month, $request->birthdate_year);

		$request->merge(array('birthdate' => $birthdate));
		$input = $request->except('birthdate_year', 'birthdate_month', 'birthdate_day');

		Owner::findOrFail($id)->first()->update($input);

		return redirect('profile');
	}

	public function updateContact(Request $request ,$id)
	{
		Owner::findOrFail($id)->first()->update($request->all());

		return redirect('profile');
	}

	public function updateAvatar(Request $request ,$id)
	{
		// User::findOrFail(decrypt($id))->firstOrFail()->update($request->all());
		//checking file is present
		if ($request->hasFile('avatar')) {
    		//verify the file is uploading
    		if ($request->file('avatar')->isValid()) {
				$avatar_ori_name = $request->avatar->getClientOriginalName();

    			//store to storage/app/owner
				$request->avatar->storeAs('owner', $request->avatar->getClientOriginalName(), 'owner');

				//store to Foos table
				$input= array(
					'filename' => $avatar_ori_name,
					'mime' => $request->avatar->getClientMimeType(),
					'original_filename' => $avatar_ori_name,
					'user_id' => Auth::user()->id,
				);
				$request->merge($input);
				Foo::create($request->except('avatar'));
				return response()->json(['response' => 'sukses', 'status' => TRUE]);
    		}else{
    			return response()->json(['gagal' => decrypt($id), 'status' => FALSE]);
    		}
		}else{
			return response()->json(['gagal' => decrypt($id), 'status' => FALSE]);
		}
		return response()->json(['response' => decrypt($id), 'status' => TRUE]);
	}
}
