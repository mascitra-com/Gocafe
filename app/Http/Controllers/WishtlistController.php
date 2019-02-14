<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id());
        return view('wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {

    }
}
