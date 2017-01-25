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
        //
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
        return view('profile/owner2');
    }
}
