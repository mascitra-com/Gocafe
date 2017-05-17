<?php

namespace App\Http\Controllers;

use App\Cafe;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cafes = Cafe::all();
        return view('homepage.index', compact('cafes'));
    }

    public function shop($cafeId)
    {
        $cafe = Cafe::where('id', $cafeId)->first();
        return view('homepage.shop', compact('cafe'));
    }

}
