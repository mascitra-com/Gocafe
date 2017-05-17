<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CategoryMenu;

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
        $categories = CategoryMenu::all()->where('cafe_id', $cafeId)->sortBy('name');
        $menus = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories->first()->id);
        return view('homepage.shop', compact('cafe', 'categories', 'menus'));
    }

}
