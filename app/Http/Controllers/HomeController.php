<?php

namespace App\Http\Controllers;

use App\Ads;
use App\Cafe;
use App\Menu;
use App\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $cafes = Cafe::with('menus')->where('logo_path', '<>', 'null')->limit(15)->get()->sortBy(function($recommend)
        {
            return $recommend->menus->sum('rating') + $recommend->menus->sum('liked');
        }, null, True);
        foreach ($cafes as $key => $cafe) {
            $cafes[$key]->logo = str_replace('storage/logo/', 'img/cache/small-logo/', Storage::url($cafe->logo_path));
        }
        $recommended = Cafe::has('menus', '>=', 5)->where('logo_path', '<>', 'null')->limit(5)->get()->sortBy(function($recommend)
        {
            return $recommend->menus->sum('rating') + $recommend->menus->sum('liked');
        }, null, True);
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
        // Favorite Menus by Total Order
        $favProducts = TransactionDetail::getTrendingProducts(3);
        foreach ($favProducts as $key => $value){
            $code_item = substr($value->item_id, 0,3);
            if($code_item === "MCF"){
                $menu = Menu::find($value->item_id);
                $favProducts[$key] = $menu;
                $favProducts[$key]->type = 'Menu';
                $thumbnail = Menu::getThumbnail($value->item_id);
                $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
                $favProducts[$key]->thumbnail = $thumbnail;
            }
            if($code_item === "PKG"){
                // TODO Fix this so that Package will have image to view
                unset($favProducts[$key]);
            }
        }
        // Most Hit By User
        $topHit = TransactionDetail::getTopHitProducts();
        $categories = DB::table('categories_menus')->select(DB::raw('distinct(name)'))->get()->toArray();
        $location = DB::table('indonesia_provinces')->select('id', 'name')->get()->toArray();
        $ads = Ads::where('page', '1')->get();
        $banner = array();
        foreach ($ads as $item) {
            $banner[] .= str_replace('banner/', 'img/cache/main-ads/', $item->banner);
        }
        $topBanner = str_replace('banner/', 'img/cache/small-ads/', Ads::where('page', '2')->first()->banner);
        $bottomBanner = str_replace('banner/', 'img/cache/small-ads/', Ads::where('page', '3')->first()->banner);
        return view('homepage.index', compact('cafes', 'favProducts', 'topHit', 'recommended', 'categories', 'location', 'banner', 'topBanner', 'bottomBanner'));
    }

    /**
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCitiesForSearch(Indonesia $indonesia)
    {
        $cities = $indonesia->allCities();
        return response()->json(['cities' => $cities]);
    }
    /**
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProvincesForSearch(Indonesia $indonesia)
    {
        $provinces = $indonesia->allProvinces();
        return response()->json(['provinces' => $provinces]);
    }

    /**
     * @param Indonesia $indonesia
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCitiesByProvinceForSearch($id, Indonesia $indonesia)
    {
        $cities = $indonesia->findProvince($id, ['cities'])->cities;
        return response()->json(['cities' => $cities]);
    }

    public function ideaBox()
    {
        return view('homepage.mailform');
    }
}
