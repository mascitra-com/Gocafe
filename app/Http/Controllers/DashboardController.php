<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Rating;
use Illuminate\Support\Facades\Auth;

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
        $listProductRatedByUser = Rating::select('item_id')->where('user_id', Auth::id())
            ->where('user_role', Auth::user()->getTable())
            ->get();
        $temp = array();
        foreach ($listProductRatedByUser as $key => $value) {
            $temp[] = $value->item_id;
        }
        session(array('rated' => $temp));
        return view('dashboard.dashboard');
    }
}
