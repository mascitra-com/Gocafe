<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BranchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Branches Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Cache::get('provinces');
        $branches = CafeBranch::all()->where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn());
        return view('branch.index', compact('provinces', 'branches'));
    }

    /**
     * Store a newly Branch Profile.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cafe $cafe)
    {
        $this->validate($request, [
            'phone' => 'max:20',
            'province_id' => 'required|exists:provinces',
            'city_id' => 'required|exists:cities',
            'open_hours' => 'required|max:10',
            'close_hours' => 'required|max:10',
        ]);
        $cafeBranch = new CafeBranch($request->all());
        $cafe->addBranch($cafeBranch, Cafe::getCafeIdByOwnerIdNowLoggedIn());
        return redirect('branch')->with('status', 'Branch added!');
    }

    /**
     * Show the form for editing the Branch Profile.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = CafeBranch::findOrFail($id);
        $provinces = Province::all();
        $idProvince = $branch->province_id;
        $cities = Province::findOrFail($idProvince)->cities;
        return view('branch.detail', compact('provinces', 'cities', 'branch'));
    }

    /**
     * Update the Branch Profile.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CafeBranch::findOrFail($id)->first()->update($request->all());
        return redirect('branch')->with('status', 'Branch updated!');
    }


    public function getCitiesByProvince(Request $request)
    {
        $idProvince = $request->input('idProvince');
        $cities = Province::findOrFail($idProvince)->cities;
        $data = array('<option>Pilih Kabupaten / Kota</option>');
        foreach ($cities as $list) {
            $data[] = "<option value='$list->city_id'>$list->city_name_full</option>";
        }
        return json_encode($data);
    }
}
