<?php

namespace App\Http\Controllers\Foo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\User;
use App\Foo;

use Storage;
use Illuminate\Http\Response;


class FooController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index()
	{
	// 	$entry = Foo::findOrFail(1)->firstOrFail();
	// 	// $path = Storage::disk('owner')->url('owner/'.$filename);

	// 	$file = Storage::disk('owner')->url($entry->filename);
 
	// 	return (new Response($file, 200))
 //              ->header('Content-Type', $entry->mime);

		// return $path;
		return view('_foo_andre.foo_upload', compact('path'));
	}

	public function get()
	{
		$entry = Foo::findOrFail(1)->firstOrFail();
		// $path = Storage::disk('owner')->url('owner/'.$filename);

		$file = Storage::disk('owner')->url($entry->filename);
 
		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
	}

	public function store(Request $request)
	{
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
				return back();
    		}else{
    			return 'not valid';
    		}
		}else{
			return 'not present';
		}

		// return $request->avatar->getMaxFileSize();
	}
}
