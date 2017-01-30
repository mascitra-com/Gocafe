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
       return view('_ui/index');
    }

    public function login()
    {
        return view('_ui/auth/login');
    }

    public function dashboard()
    {
        return view('_ui/dashboard/tes');
    }

    public function profile()
    {
        return view('_ui/owner/owner_profile');
    }

    public function cafe()
    {
        return view('_ui/cafe/cafe_profile');
    }

    public function staff()
    {
        return view('_ui/staff/staff');
    }

    public function staff_create()
    {
        return view('_ui/staff/create');
    }

    public function staff_detail()
    {
        return view('_ui/staff/detail');
    }

    public function branch()
    {
        return view('_ui/branch/branch');
    }
}
