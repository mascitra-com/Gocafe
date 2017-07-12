<?php

namespace App\Http\Controllers;

/**
 * Class DashboardController untuk Halaman Dashboard
 * @package App\Http\Controllers
 */
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin-dashboard.dashboard');
    }
}
