<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;
use App\User;
use App\Owner;
use App\Cafe;

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
        $owner_id = $user->getOwnerByUserId(Auth::user()->id)->id;
        $cafe_id = $owner->getCafeByOwnerId($owner_id)->id;

        $staffs = Cafe::findOrFail($cafe_id)->staffs;

        return view('staff/staff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Owner $owner)
    {
        $owner_id = $user->getOwnerByUserId(Auth::user()->id)->id;
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
        $staff = new Staff($request->all());

        return $staff;
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
        //
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
        //
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
}
