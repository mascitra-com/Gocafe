<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use App\Package;
use App\Review;
use Laravolt\Indonesia\Indonesia;

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
     * @param Indonesia $indonesia
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($cafeId, Indonesia $indonesia)
    {
        $cafe = Cafe::where('id', $cafeId)->first();
        $branches = CafeBranch::all()->where('cafe_id', $cafeId);
        // Get Location Name for each branch
        if (isset($branches)) {
            foreach ($branches as $branch) {
                $this->get_location($branch, $indonesia);
            }
        }
        $categories = CategoryMenu::getCategoryHasMenu($cafeId);
        $products = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories[0]->id);
        return view('shop.detail', compact('cafe', 'branches', 'categories', 'products'));
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
}
