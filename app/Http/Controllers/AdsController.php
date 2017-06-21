<?php

namespace App\Http\Controllers;

use App\Ads;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
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
                $banner_name = idWithPrefix(14);
                $banner_mime = $request->file->getClientMimeType();
                //store to storage/app/owner
                $request->file->storeAs('banner', $banner_name, 'banner');
                //update avatar_ users table
                $input = array(
                    'banner' => $banner_name,
                    'banner_mime' => $banner_mime,
                );
                $request->merge($input);
                $ads = new Ads($request->except('file'));
                $ads->created_by = Auth::user()->id;
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
        return view('ads.create', compact('ads'));
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
                $banner_name = idWithPrefix(14);
                $banner_mime = $request->file->getClientMimeType();
                //store to storage/app/owner
                $request->file->storeAs('banner', $banner_name, 'banner');
                //update avatar_ users table
                $input = array(
                    'banner' => $banner_name,
                    'banner_mime' => $banner_mime,
                );
                $request->merge($input);
                $ads = Ads::find($id);
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
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @param Ads $ads
     * @return $this
     * @internal param Cafe $cafe
     */
    public function showBanner($id, Ads $ads)
    {
        $banner_instance = $ads->getBanner($id, 'banner', 'banner');
        return (new Response($banner_instance[0], 200))->header('Content-Type', $banner_instance[1]);
    }
}
