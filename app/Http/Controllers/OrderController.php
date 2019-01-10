<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        if (Auth::user()->role == 'owner') {
            exit('Halaman Tidak Tersedia');
        } else {
            $cafeId = Staff::getCafeIdByStaffIdNowLoggedIn();
            $numberOfTables = CafeBranch::getNumberOfTablesByStaffNowLoggedIn();
        }
        // Get List of Category and All Menus from first Category
        $categories = CategoryMenu::all()->where('cafe_id', $cafeId)->sortBy('name');
        $menus = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories->first()->id);
        $thumbnail = Menu::getThumbnail($menus->first()->id);
        $thumbnail = str_replace('storage/product/', 'img/cache/medium-product/', $thumbnail[0]);
        $menus->first()->thumbnail = $thumbnail;
        $firstMenu = $menus->first();
        foreach ($menus as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
            $menus[$key]->thumbnail = $thumbnail;
        }
        $packages = Package::where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn())->with('menus')->get();

        return view('transaction.order', compact('categories', 'menus', 'firstMenu', 'numberOfTables', 'reviews', 'packages'));
    }
}
