<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CategoryMenu;
use App\Menu;
use App\Package;
use App\Review;

class ShopController extends Controller
{
    /**
     * Display All Shop
     */
    public function recommended()
    {
        $recommended = Cafe::limit(5)->with('latestMenu')->get();
        return view('shop.list', compact('recommended'));
    }

    /**
     * Display Shop Detail with All Product Provided
     *
     * @param $cafeId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($cafeId)
    {
        $cafe = Cafe::where('id', $cafeId)->first();
        $categories = CategoryMenu::all()->where('cafe_id', $cafeId)->sortBy('name');
        $products = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories->first()->id);
        return view('shop.detail', compact('cafe', 'categories', 'products'));
    }

    /**
     * Display product detail
     *
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    public function load($offset)
    {
        $recommended = Cafe::offset($offset)->limit(3)->with('latestMenu')->get();
        return response()->json(['recommended' => $recommended]);
    }
}
