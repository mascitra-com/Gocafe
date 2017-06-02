<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
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
        $recommended = Cafe::limit(5)->with('latestMenu')->get();
        return view('shop.recommended', compact('recommended'));
    }

    /**
     * Display Shop Detail with All Product Provided
     *
     * @param $shopId
     * @param Indonesia $indonesia
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($shopId, Indonesia $indonesia)
    {
        $shop = Cafe::where('id', $shopId)->first();
        $branches = CafeBranch::all()->where('cafe_id', $shopId);
        // Get Location Name for each branch
        if (isset($branches)) {
            foreach ($branches as $branch) {
                $this->get_location($branch, $indonesia);
            }
        }
        $categories = CategoryMenu::getCategoryHasMenu($shopId);
        $products = Cafe::findOrFail($shopId)->menus;
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
    /**
     * Get Location Name by ID Location and Length of ID that determine location type.
     *
     * @param $branch
     * @param Indonesia $indonesia
     */
    public static function get_location($branch, Indonesia $indonesia)
    {
        $locationLength = strlen($branch->location_id);
        switch ($locationLength) {
            case 2:
                $branch->location = $indonesia->findProvince($branch->location_id);
                break;
            case 4:
                $branch->location = $indonesia->findCity($branch->location_id, ['province']);
                break;
            case 7:
                $branch->location = $indonesia->findDistrict($branch->location_id, ['city', 'province']);
                break;
        }
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
