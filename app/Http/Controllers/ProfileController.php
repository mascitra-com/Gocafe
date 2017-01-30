<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;
use Auth;

class ProfileController extends Controller
{
	public function index()
	{

	}

	public function edit(User $user, $id)
	{
		$role = $user->get_role($id);

		if ($role === 'owner') {
			$profile = User::find($id)->owner;
			return view('owner.owner_profile', compact('profile'));
		}elseif ($role === 'staff') {
			return 'ambil profil staff (progress)';
		}else{
			return 'error';
		}
	}
}
