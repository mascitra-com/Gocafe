<?php

namespace App\Http\Controllers;

use App\Ads;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin_user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::all();
        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            //verify the file is uploading
            if ($request->file('file')->isValid()) {
                $path = $request->file('file')->store('banner', 'banner');
                $input = array(
                    'banner' => $path,
                );
                $request->merge($input);
                $ads = new Ads($request->except('file'));
                $ads->created_by = 1;
                $ads->save();
                return redirect('ads')->with('status', 'Iklan baru telah di tambahkan');
            } else {
                return redirect('ads')->with('status', 'Terjadi Kesalahan');
            }
        } else {
            return redirect('ads')->with('status', 'Terjadi Kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ads = Ads::find($id);
        $banner = Storage::url($ads->banner);
        return view('ads.create', compact('ads', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            //verify the file is uploading
            if ($request->file('file')->isValid()) {
                $path = $request->file('file')->store('banner', 'banner');
                $input = array(
                    'banner' => $path,
                );
                $request->merge($input);
                $ads = Ads::find($id);
                if($exists = Storage::disk('banner')->exists($ads->banner))
                    Storage::delete("public/$ads->banner");
                $ads->update($request->all());
                return redirect('ads')->with('status', 'Iklan telah di update');
            } else {
                return redirect('ads')->with('status', 'Terjadi Kesalahan');
            }
        } else {
            return redirect('ads')->with('status', 'Terjadi Kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
    public function delete($id)
    {
        $info = Ads::find($id);
        $info->forceDelete();
        return redirect('ads')->with('status', 'Iklan yang Anda pilih sudah di hapus');
    }

}
