<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Laravolt\Indonesia\Indonesia;

class ShopController extends Controller
{
    /**
     * Display All Shop
     */
    public function recommended()
    {
        $recommended = Cafe::limit(5)->get();
        foreach ($recommended as $key => $recommend) {
            $recommended[$key]->latestMenu = Menu::where('cafe_id', $recommend->id)->limit(5)->get();
        }
        return view('shop.recommended', compact('recommended'));
    }

    /**
     * Display Shop Detail with All Product Provided
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($slug)
    {
        $shop = Cafe::where('slug', $slug)->first();
        $branches = CafeBranch::all()->where('cafe_id', $shop->id);
        $categories = CategoryMenu::getCategoryHasMenu($shop->id);
        $products = Cafe::findOrFail($shop->id)->menus;
        return view('shop.index', compact('shop', 'branches', 'categories', 'products'));
    }

    public function allProducts($shopId)
    {
        $products = Cafe::findOrFail($shopId)->menus;
        return response()->json(['products' => $products]);
    }

    public function load($offset)
    {
        $recommended = Cafe::offset($offset)->limit(3)->with('latestMenu')->get();
        return response()->json(['recommended' => $recommended]);
    }

    public function search()
    {
        $filter['query'] = Input::get('query');;
        $query = explode(' ', $filter['query']);
        $list = DB::table('cafes')->select('*');
        foreach($query as $key => $element) {
            if($key == 0) {
                $list->where('name', 'like', "%$element%");
            }
            $list->orWhere('name', 'like', "%$element%");
        }
        $shopList = $list->get();
        return view('shop.list', compact('filter', 'shopList'));
    }
}
