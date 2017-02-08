<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;
use App\User;
use App\Owner;
use App\Cafe;
use App\CafeBranch;


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
    public function create(User $user, Owner $owner)
    {
        $owner_id = $user->getAccountByUserId(Auth::user()->id)->id;
        $cafe_id = $owner->getCafeByOwnerId($owner_id)->id;

        $branches = Cafe::findOrFail($cafe_id)->branches;
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
}
