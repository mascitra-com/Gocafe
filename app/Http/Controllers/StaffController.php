<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;
use App\User;
use App\Owner;
use App\Cafe;
use App\CafeBranch;
use App\Position;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;

use Laravolt\Indonesia\Indonesia;
use Excel;

use Auth;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Owner $owner)
    {
        if(!Cafe::getCafeIdByOwnerIdNowLoggedIn()){
            return redirect('profile/cafe')->with('status', 'Cafe Profile Must Be Filled!');
        }
        if(!CafeBranch::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->count()){
            return redirect('branch')->with('status', 'You Must At Least Have One Cafe Branch');
        }
        $owner_id = $user->getAccountByUserId(Auth::user()->id)->id;
        $cafe_id = $owner->getCafeByOwnerId($owner_id)->id;

        $staffs = Cafe::findOrFail($cafe_id)->staffs->load('branches', 'position');
    
        return view('staff/staff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Owner $owner, Indonesia $indonesia)
    {
        $owner_id = $user->getAccountByUserId(Auth::user()->id)->id;
        $cafe_id = $owner->getCafeByOwnerId($owner_id)->id;

        $branches = Cafe::findOrFail($cafe_id)->branches;
         // Get Location Name for each branch
        if (isset($branches)) {
            foreach ($branches as $branch) {
                $this->get_location($branch, $indonesia);
            }
        }
        $positions = Cafe::findOrFail($cafe_id)->positions;
        return view('staff.create', compact('branches', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User($request->only(['email']));
        $user_id = $user->addUser($user, $request->password, 'staff');

        $birthdate = frmtPartDate($request->birthdate_day, $request->birthdate_month, $request->birthdate_year);
        $phone = '+62'.$request->phone_input;
        $request->merge(array('id' => idWithPrefix(2) ,'user_id' => $user_id, 'birthdate' => $birthdate, 'phone' => $phone, 'created_by' => Auth::user()->id));
        Staff::create($request->except(['email', 'password', 'confirm_password', 'birthdate_day', 'birthdate_year', 'birthdate_month', 'phone_input']));

        return redirect('staff');
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
    public function edit(User $user, Owner $owner, Staff $staff)
    {
        $owner_id = $user->getAccountByUserId(Auth::user()->id)->id;
        $cafe_id = $owner->getCafeByOwnerId($owner_id)->id;
        $branches = Cafe::findOrFail($cafe_id)->branches;
        $positions = Cafe::findOrFail($cafe_id)->positions;
        return view('staff/detail', compact('staff', 'branches', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        User::findOrFail($staff->user->id)->update($request->only(['email']));        

        $birthdate = frmtPartDate($request->birthdate_day, $request->birthdate_month, $request->birthdate_year);
        $phone = '+62'.$request->phone_input;
        $request->merge(array('birthdate' => $birthdate, 'phone' => $phone, 'created_by' => Auth::user()->id));
        Staff::findOrFail($staff->id)->update(($request->except(['email', 'password', 'confirm_password', 'birthdate_day', 'birthdate_year', 'birthdate_month', 'phone_input'])));

        return redirect('staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
    }

    /**
     * Import excel file then insert values to database from the datasheets.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {
        //checking file is present
        if ($request->hasFile('import_excel')) {
            //verify the file is uploading
            if ($request->file('import_excel')->isValid()) {
                $path = $request->import_excel->getRealPath();
                
                //passing excel datasheets's values
                $data = Excel::load($path, function($reader) {
                })->get();

                if(!empty($data) && $data->count()){
                        foreach ($data as $key => $value) {

                            //change gender value
                            if ($value->gender === 'L') {
                                $gender = '0';
                            }elseif ($value->gender === 'P') {
                                $gender = '1';
                            }

                            //change branch value

                            //change position value
                            $position_id =Position::where('title' ,$value->position)->where('branch_id', 'CFBAgm20170210063008')->firstOrFail()->id;

                            $insert[] = [
                            'email' => $value->email, 
                            'password' => $value->password,
                            'first_name' => $value->first_name,
                            'last_name' => $value->last_name,
                            'address' => $value->address,
                            'birthdate' => $value->birthdate,
                            'gender' => $gender,
                            'phone' => $value->phone,
                            // 'branch_id' => $value->branch,
                            'branch_id' => 'CFBAgm20170210063008',
                            'position_id' => $position_id,
                            ];
                        }
                    if(!empty($insert)){
                        // dd(array_only($insert[0], ['email']));
                        for ($i=0; $i <sizeof($insert) ; $i++) {
                            $user = new User(array_only($insert[$i], ['email']));
                            $user_id = $user->addUser($user, $insert[$i]['password'], 'staff');
                            $insert[$i] = array_add($insert[$i], 'id', idWithPrefix(2));
                            $insert[$i] = array_add($insert[$i], 'user_id', $user_id);
                            $insert[$i] = array_add($insert[$i], 'created_by', Auth::user()->id);
                            Staff::create(array_except($insert[$i], ['email', 'password']));    
                        }
                        return redirect('staff');
                    }else{
                        return 'Terjadi kesalahan dalam input data ke database';
                    }
                }else{
                    return 'Data dalam excel tidak boleh kosong';
                }
            }else{
                return 'terjadi kesalahan dalam upload';
            }
        }else{
            return 'file kosong';
        }
        return 'sukses';
    }

    /**
     * Download excel which contain the template for inputing staff datas.
     *
     */
    public function downloadExcel()
    {
        $file= Storage::disk('public')->get('staff_template.xlsx');
        return (new Response($file, 200))
        ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

     /**
     * Get Location Name by ID Location and Length of ID that determine location type.
     *
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
