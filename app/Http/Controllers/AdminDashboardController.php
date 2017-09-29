<?php

namespace App\Http\Controllers;

class AdminDashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin_user');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin-dashboard.dashboard');
    }
}
