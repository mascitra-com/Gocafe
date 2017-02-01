<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;
use Auth;

class ProfileController extends Controller
{
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
}
