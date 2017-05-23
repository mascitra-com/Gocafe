<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Menu;
use App\TransactionDetail;
use Laravolt\Indonesia\Indonesia;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\Response
     */
    public function index(Indonesia $indonesia)
    {
        $cafes = Cafe::all();
        $recommended = Cafe::limit(3)->with('latestMenu')->get();
        // Favorite Menus
        $favProducts = TransactionDetail::getTrendingProducts(1);
        foreach ($favProducts as $key => $value){
            $code_item = substr($value->item_id, 0,3);
            if($code_item === "MCF"){
                $menu = Menu::find($value->item_id);
                $favProducts[$key]->name = $menu->name;
                $favProducts[$key]->type = 'Menu';
            }
            if($code_item === "PKG"){
                // TODO Fix this so that Package will have image to view
                unset($favProducts[$key]);
            }
        }
        $cities = $indonesia->allCities();
        return view('homepage.index', compact('cafes', 'favProducts', 'recommended', 'cities'));
    }

}
