<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ui extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('ui');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function dashboard()
    {
        return view('dashboard/tes');
    }

    public function profile()
    {
        return view('owner/owner_profile');
    }

    public function cafe()
    {
        return view('cafe/cafe_profile');
    }

    public function staff()
    {
        return view('staff/staff');
    }

    public function staff_create()
    {
        return view('staff/create');
    }

    public function staff_detail()
    {
        return view('staff/detail');
    }
}
