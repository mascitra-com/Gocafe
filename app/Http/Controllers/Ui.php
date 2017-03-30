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

    public function branch_detail()
    {
        return view('_ui/branch/detail');
    }

    public function position()
    {
        return view('_ui/staff/position');
    }

    public function account()
    {
        return view('_ui/auth/account');
    }

    public function menu()
    {
        return view('_ui/menu/menu');
    }

    public function menu_create()
    {
        return view('_ui/menu/create');
    }

    public function kategori()
    {
        return view('_ui/menu/kategori');
    }

    public function discount()
    {
        return view('_ui/discount/discount');
    }

    public function discount_create()
    {
        return view('_ui/discount/create');
    }

    public function package()
    {
        return view('_ui/package/package');
    }

    public function package_create()
    {
        return view('_ui/package/create');
    }
}
