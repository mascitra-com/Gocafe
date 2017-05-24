<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Menu;
use App\Package;
use App\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{

    public function search()
    {
        $filter['product'] = Input::get('product');
        $filter['location'] = Input::get('location');
        $filter['orderBy'] = Input::get('order');
        $categories = DB::table('categories_menus')->select(DB::raw('distinct(name)'))->get()->toArray();
        $query = explode(' ', $filter['product']);
        $list = DB::table('menus')->select('*');
        foreach($query as $key => $element) {
            if($key == 0) {
                $list->where('name', 'like', "%$element%");
            }
            $list->orWhere('name', 'like', "%$element%");
        }
        $productList = $list->get();
        return view('product.list', compact('product', 'categories', 'productList', 'filter'));
    }
    /**
     * Display product detail
     *
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($productId)
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
        return view('product.detail', compact('cafe', 'product', 'reviews'));
    }

}
