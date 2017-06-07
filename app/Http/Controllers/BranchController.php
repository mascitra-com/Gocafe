<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Indonesia;
use Validator;

/**
 * Class BranchController untuk Fitur Branches
 * @package App\Http\Controllers
 */
class BranchController extends Controller
{
    /**
     * Display a listing of the Branches Profile.
     *
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\Response
     */
    public function index(Indonesia $indonesia)
    {
        if (!Cafe::getCafeIdByUserIdNowLoggedIn()) {
            return redirect('profile/cafe')->with('status', 'Cafe Profile Must Be Filled!');
        }
        // Get All Provinces and All Cafe Branch by Cafe ID and Owner ID
        $provinces = $indonesia->allProvinces();
        $branches = CafeBranch::all()->where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn());
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
        // Validate required data
        $this->validate($request, [
            'phone' => 'max:20',
            'address' => 'required',
            'open_hours' => 'required|max:10',
            'close_hours' => 'required|max:10',
        ]);

        // Validate the location which must be one selected
        $validator = Validator::make($request->only('province_id', 'city_id', 'district_id'), [
            'province_id' => 'required',
            'city_id' => 'required_unless:district_id,' . NULL,
        ]);
        if ($validator->fails()) {
            return redirect('branch')
                ->withErrors('Location must be selected')
                ->withInput();
        }
        // Save request except 3 parameters which won't be store to the database
        $cafeBranch = new CafeBranch($request->all());
        $cafe->addBranch($cafeBranch, Cafe::getCafeIdByUserIdNowLoggedIn());
        return redirect('branch')->with('status', 'Branch added!');
    }

    /**
     * Show the form for editing the Branch Profile.
     *
     * @param  int $id
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Indonesia $indonesia)
    {
        $branch = CafeBranch::findOrFail($id);
        $provinces = $indonesia->allProvinces();
        $cities = $indonesia->findProvince($branch->province->id, ['cities'])->cities;
        $districts = $indonesia->findCity($branch->city->id, ['districts'])->districts;
        return view('branch.detail', compact('branch', 'provinces', 'cities', 'districts'));
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
        CafeBranch::find($id)->update($request->all());
        return redirect('branch')->with('status', 'Branch updated!');
    }

    /**
     * Get All Cities by Province ID
     *
     * @param Request $request
     * @param Indonesia $indonesia
     * @return string of Combo box attributes
     */
    public function getCitiesByProvince(Request $request, Indonesia $indonesia)
    {
        $idProvince = $request->input('idProvince');
        $cities = $indonesia->findProvince($idProvince, ['cities'])->cities;
        $data = array('<option value="">Pilih Kabupaten / Kota</option>');
        // Store all cities to array as combo box attribute
        foreach ($cities as $list) {
            $data[] = "<option value='$list->id'>$list->name</option>";
        }
        return json_encode($data);
    }

    /**
     * Get All Districts by City ID
     *
     * @param Request $request
     * @param Indonesia $indonesia
     * @return string of Combo box attributes
     */
    public function getDistrictByCity(Request $request, Indonesia $indonesia)
    {
        $idCity = $request->input('idCity');
        $districts = $indonesia->findCity($idCity, ['districts'])->districts;
        $data = array('<option value="">Pilih Kecamatan</option>');
        // Store all districts to array as combo box attribute
        foreach ($districts as $list) {
            $data[] = "<option value='$list->id'>$list->name</option>";
        }
        return json_encode($data);
    }
}
