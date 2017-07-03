<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
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
            $latestMenu = Menu::where('cafe_id', $recommend->id)->limit(5)->get();
            foreach ($latestMenu as $keyMenu => $value) {
                $thumbnail = Menu::getThumbnail($value->id);
                $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
                $latestMenu[$keyMenu]->thumbnail = $thumbnail;
            }
            $recommended[$key]->latestMenu = $latestMenu;
            $recommended[$key]->logo = str_replace('storage/logo/', 'img/cache/medium-logo/', Storage::url($recommend->logo_path));
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
        foreach ($products as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
            $products[$key]->thumbnail = $thumbnail;
        }
        $cover = str_replace('storage/cover/', 'img/cache/huge-cover/', Storage::url($shop->cover_path));
        $logo = str_replace('storage/logo/', 'img/cache/small-logo/', Storage::url($shop->logo_path));
        return view('shop.index', compact('cover', 'logo', 'shop', 'branches', 'categories', 'products'));
    }

    public function allProducts($shopId)
    {
        $products = Cafe::findOrFail($shopId)->menus;
        foreach ($products as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
            $products[$key]->thumbnail = $thumbnail;
        }
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
        foreach ($shopList as $key => $list) {
            $shopList[$key]->logo = str_replace('storage/logo/', 'img/cache/medium-logo/', Storage::url($list->logo_path));
        }
        return view('shop.list', compact('filter', 'shopList'));
    }
}
