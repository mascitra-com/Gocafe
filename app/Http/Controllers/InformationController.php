<?php

namespace App\Http\Controllers;

use App\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = Info::withTrashed()->get();
        return view('info.footer.index', compact('information'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $part = $this->footerPart();
        return view('info.footer.create', compact('part'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = new Info($request->all());
        $info->created_by = 1;
        $info->save();
        return redirect('info')->with('status', 'Data Informasi telah di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Info::find($id);
        return view('info.index', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Info::find($id);
        $part = $this->footerPart();
        return view('info.footer.create', compact('info', 'part'));
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
        $info = Info::find($id);
        $info->update($request->all());
        return redirect('info')->with('status', 'Data Informasi telah di Ubah');
    }

    /**
     * Deactivate the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        Info::where('id', $id)->restore();
        return redirect('info')->with('status', 'Informasi yang Anda pilih sudah di Aktifkan');
    }
    /**
     * Deactivate the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        Info::destroy($id);
        return redirect('info')->with('status', 'Informasi yang Anda pilih sudah di Non-aktifkan');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = Info::find($id);
        $info->forceDelete();
        return redirect('info')->with('status', 'Informasi yang Anda pilih sudah di hapus');
    }

    /**
     * About Us.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aboutUs()
    {
        return view('info.about-us');
    }

    /**
     *
     */
    private function footerPart()
    {
        return array(
            '1' => 'Kulinerae',
            '2' => 'Layanan Pelanggan',
            '3' => 'Fitur Seru Kami'
        );
    }
}
