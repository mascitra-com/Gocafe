<?php

namespace App\Http\Controllers;

use App\Owner;
use App\CafeBranch;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    /**
     * Display a listing of the Branches Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$provinces = Cache::get('provinces')){
            $provinces = Province::all();
            Cache::forever('provinces', $provinces);
        }
        $owner = new Owner();
        $cafe_id = $owner->getCafeIdByOwnerIdNowLoggedIn();
        $branches = CafeBranch::all()->where('cafe_id', $cafe_id);
        $branches->load('city', 'province');
        return view('branch.index', compact('provinces', 'branches'));
    }

    /**
     * Store a newly Branch Profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'max:20',
            'province_id' => 'required|exists:provinces',
            'city_id' => 'required|exists:cities',
            'phone' => 'max:20',
            'open_hours' => 'required|max:10',
            'close_hours' => 'required|max:10',
        ]);
        $owner = new Owner();
        $owner->id = $owner->getOwnerIdByUserIdNowLoggedIn();
        $cafeBranch = new CafeBranch($request->all());
        $owner->addBranch($cafeBranch);
        return redirect('branch')->with('status', 'Branch added!');
    }

    /**
     * Show the form for editing the Branch Profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = CafeBranch::find($id);
        if(!$provinces = Cache::get('provinces')){
            $provinces = Province::all();
            Cache::forever('provinces', $provinces);
        }
        $idProvince = $branch->province_id;
        if(!$cities = Cache::get('cities-'.$idProvince)) {
            $cities = Province::find($idProvince)->cities;
            Cache::forever('cities-'.$idProvince, $cities);
        }
        return view('branch.detail', compact('provinces', 'cities', 'branch'));
    }

    /**
     * Update the Branch Profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CafeBranch::findOrFail($id)->first()->update($request->all());
        return redirect("branch")->with('status', 'Branch updated!');
    }


    public function getCitiesByProvince(Request $request)
    {
        $idProvince = $request->input('idProvince');
        if(!$cities = Cache::get('cities-'.$idProvince)) {
            $cities = Province::find($idProvince)->cities;
            Cache::forever('cities-'.$idProvince, $cities);
        }
        $data = array('<option>Pilih Kabupaten / Kota</option>');
        foreach ($cities as $list) {
            array_push($data, "<option value='$list->city_id'>$list->city_name_full</option>");
        }
        return json_encode($data);
    }
}
