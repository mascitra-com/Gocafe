<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CategoryMenu;
use App\Menu;
use App\Package;
use App\Review;

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
        $products = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories->first()->id);
        return view('homepage.shop', compact('cafe', 'categories', 'products'));
    }

    public function product($productId)
    {
        $product = array();
        $code_item = substr($productId, 0,3);
        if($code_item === "MCF"){
            $product = Menu::find($productId);
            $product->type = 'Menu';
        }
        if($code_item === "PKG"){
            $product = Package::find($productId);
            $product->type = 'Paket';
        }
        $cafe = Cafe::find($product->cafe_id);
        $reviews = Review::where('item_id', $productId)->orderBy('id', 'desc')->get();
        return view('homepage.product', compact('cafe', 'product', 'reviews'));
    }

}
