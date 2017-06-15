<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Menu;
use App\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Indonesia;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cafes = Cafe::limit(15)->get();
        $recommended = Cafe::limit(5)->get();
        foreach ($recommended as $key => $recommend) {
            $recommended[$key]->latestMenu = Menu::where('cafe_id', $recommend->id)->limit(4)->get();
        }
        // Most Hit By User
        $topHit = TransactionDetail::getTopHitProducts();
        // Favorite Menus by Total Order
        $favProducts = TransactionDetail::getTrendingProducts(1);
        foreach ($favProducts as $key => $value){
            $code_item = substr($value->item_id, 0,3);
            if($code_item === "MCF"){
                $menu = Menu::find($value->item_id);
                $favProducts[$key] = $menu;
                $favProducts[$key]->type = 'Menu';
            }
            if($code_item === "PKG"){
                // TODO Fix this so that Package will have image to view
                unset($favProducts[$key]);
            }
        }
        $categories = DB::table('categories_menus')->select(DB::raw('distinct(name)'))->get()->toArray();
        return view('homepage.index', compact('cafes', 'favProducts', 'topHit', 'recommended', 'categories'));
    }

    /**
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProvincesForSearch(Indonesia $indonesia)
    {
        $cities = $indonesia->allCities();
        return response()->json(['cities' => $cities]);
    }

    public function ideaBox()
    {
        return view('homepage.mailform');
    }
}
