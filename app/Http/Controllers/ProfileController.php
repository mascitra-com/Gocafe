<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;
use Auth;

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

	public function updateAvatar($id)
	{
		// User::findOrFail(decrypt($id))->firstOrFail()->update($request->all());
		return response()->json(['response' => decrypt($id)]);
	}
}
