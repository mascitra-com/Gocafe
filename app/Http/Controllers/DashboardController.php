<?php

namespace App\Http\Controllers;

use App\Cafe;

/**
 * Class DashboardController untuk Halaman Dashboard
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Cafe::setLastAccessed();
        return view('dashboard.dashboard');
    }
}
