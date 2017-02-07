<?php

namespace App\Http\Controllers;

use Validator;
use App\Cafe;
use App\CafeBranch;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Indonesia;

class BranchController extends Controller
{
    /**
     * Create a new controller instance.
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
    public function index(Indonesia $indonesia)
    {
        $provinces = $indonesia->allProvinces();
        $branches = CafeBranch::all()->where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn());
        if (isset($branches)) {
            foreach ($branches as $branch){
                $this->get_location($branch, $indonesia);
            }
        }
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
            'address' => 'required',
            'phone' => 'max:20',
            'open_hours' => 'required|max:10',
            'close_hours' => 'required|max:10',
        ]);

        $validator = Validator::make($request->only('province_id', 'city_id', 'district_id'), [
            'province_id' => 'required' . NULL,
            'city_id' => 'required_unless:district_id,' . NULL,
        ]);

        if ($validator->fails()) {
            return redirect('branch')
                ->withErrors('Location must be selected')
                ->withInput();
        }

        $location_id = $request->province_id;
        if($request->city_id){
            $location_id = $request->city_id;
        }
        if($request->district_id){
            $location_id = $request->district_id;
        }
        $request->request->add(array('location_id' => $location_id));

        $cafeBranch = new CafeBranch($request->except('province_id', 'city_id', 'district_id'));
        $cafe->addBranch($cafeBranch, Cafe::getCafeIdByOwnerIdNowLoggedIn());
        return redirect('branch')->with('status', 'Branch added!');
    }

    /**
     * Show the form for editing the Branch Profile.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Indonesia $indonesia)
    {
        $branch = CafeBranch::findOrFail($id);
        $this->get_location($branch, $indonesia);
        $provinces = $indonesia->allProvinces();
        return view('branch.detail', compact('branch', 'provinces'));
    }

    /**
     * Update the Branch Profile.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO validate the input that must be have one location
        $location_id = $request->province_id;
        if($request->city_id){
            $location_id = $request->city_id;
        }
        if($request->district_id){
            $location_id = $request->district_id;
        }
        $request->request->add(array('location_id' => $location_id));
        CafeBranch::find($id)->update($request->except('province_id', 'city_id', 'district_id'));
        return redirect('branch')->with('status', 'Branch updated!');
    }


    /**
     * @param Request $request
     * @param Indonesia $indonesia
     * @return string
     */
    public function getCitiesByProvince(Request $request, Indonesia $indonesia)
    {
        $idProvince = $request->input('idProvince');
        $cities = $indonesia->findProvince($idProvince, ['cities'])->cities;
        $data = array('<option value="">Pilih Kabupaten / Kota</option>');
        foreach ($cities as $list) {
            $data[] = "<option value='$list->id'>$list->name</option>";
        }
        return json_encode($data);
    }
    /**
     * @param Request $request
     * @param Indonesia $indonesia
     * @return string
     */
    public function getDistrictByCity(Request $request, Indonesia $indonesia)
    {
        $idCity = $request->input('idCity');
        $districts = $indonesia->findCity($idCity, ['districts'])->districts;
        $data = array('<option value="">Pilih Kecamatan</option>');
        foreach ($districts as $list) {
            $data[] = "<option value='$list->id'>$list->name</option>";
        }
        return json_encode($data);
    }

    /**
     * @param $branch
     * @param Indonesia $indonesia
     */
    private function get_location($branch, Indonesia $indonesia)
    {
        $locationLength = strlen($branch->location_id);
        switch ($locationLength) {
            case 2:
                $branch->location = $indonesia->findProvince($branch->location_id);
                break;
            case 4:
                $branch->location = $indonesia->findCity($branch->location_id, ['province']);
                break;
            case 7:
                $branch->location = $indonesia->findDistrict($branch->location_id, ['city', 'province']);
                break;
        }
    }
}
