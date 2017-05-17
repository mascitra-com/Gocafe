<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\Owner;
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
        // Get Location Name for each branch
        if (isset($branches)) {
            foreach ($branches as $branch) {
                $this->get_location($branch, $indonesia);
            }
        }
        return view('branch.index', compact('provinces', 'branches'));
    }

    /**
     * Get Location Name by ID Location and Length of ID that determine location type.
     *
     * @param $branch
     * @param Indonesia $indonesia
     */
    public static function get_location($branch, Indonesia $indonesia)
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
        // Set Location ID and add Location ID as request attribute
        $location_id = $this->set_location_id($request);
        $request->request->add(array('location_id' => $location_id));
        // Save request except 3 parameters which won't be store to the database
        $cafeBranch = new CafeBranch($request->except('province_id', 'city_id', 'district_id'));
        $cafe->addBranch($cafeBranch, Cafe::getCafeIdByUserIdNowLoggedIn());
        return redirect('branch')->with('status', 'Branch added!');
    }

    /**
     * Set Location ID by the last location selected. Left to Right Priority province_id|city_id|district_id.
     *
     * @param Request $request
     * @return Location ID
     */
    public static function set_location_id(Request $request)
    {
        $location_id = $request->province_id;
        if ($request->city_id) {
            $location_id = $request->city_id;
        }
        if ($request->district_id) {
            $location_id = $request->district_id;
            return $location_id;
        }
        return $location_id;
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
        $this->get_location($branch, $indonesia);
        $currentLocation = $indonesia->findDistrict($branch->location_id, ['city.province']);
        $current = new \stdClass();
        $current->district = $currentLocation;
        $current->city = $currentLocation->city;
        $current->province = $currentLocation->city->province;
        $provinces = $indonesia->allProvinces();
        $cities = $indonesia->findProvince($current->province->id, ['cities'])->cities;
        $districts = $indonesia->findCity($current->city->id, ['districts'])->districts;
        return view('branch.detail', compact('branch', 'current', 'provinces', 'cities', 'districts'));
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
        // Set Location ID and add Location ID as request attribute
        $location_id = $this->set_location_id($request);
        $request->request->add(array('location_id' => $location_id));
        // Save request except 3 parameters which not include in database
        CafeBranch::find($id)->update($request->except('province_id', 'city_id', 'district_id'));
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
