<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Menu;
use App\Package;
use App\Review;
use App\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Laravolt\Indonesia\Indonesia;

class ProductController extends Controller
{

    public function search()
    {
        $indonesia = new Indonesia();
        $filter['province'] = Input::get('province');
        $filter['city'] = Input::get('city');
        $filter['orderBy'] = Input::get('order');
        $filter['lowPrice'] = Input::get('lowPrice') ? str_replace('.', '', Input::get('lowPrice')) : '';
        $filter['highPrice'] = Input::get('highPrice') ? str_replace('.', '', Input::get('highPrice')) : '';
        $categories = DB::table('categories_menus')->select(DB::raw('distinct(name)'))->get()->toArray();
        $list = DB::table('menus')->select('menus.*', 'cafes.name as cafe_name');
        $filter['query'] = Input::get('query');
        // Search By Words
        $list->orWhere(function ($q) {
            $query = explode(' ', Input::get('query'));
            foreach($query as $key => $element) {
                if($key == 0) {
                    $q->where('menus.name', 'like', "%$element%");
                }
                $q->orWhere('menus.name', 'like', "%$element%");
            }
        });
        // Order
        switch ($filter['orderBy']) {
            case '1':
                $list->orderBy('reviewed', 'desc');
                break;
            case '2':
                $list->orderBy('rating', 'desc');
                break;
            case '3':
                $list->orderBy('price', 'asc');
                break;
            case '4':
                $list->orderBy('price', 'desc');
                break;
            case '5':
                $list->orderBy('menus.created_at', 'desc');
                break;
            default:
                $list->orderBy('hit', 'desc');
                break;
        }
        // Search By Price
        if($filter['lowPrice']) {
            $list->where('price', '>=', $filter['lowPrice']);
        }
        if($filter['highPrice']) {
            $list->where('price', '<=', $filter['highPrice']);
        }
        $list->where('menus.deleted_at', NULL);
        $list->join('cafes', 'cafes.id', '=', 'menus.cafe_id');
        $list->join('cafe_branches', 'cafes.id', '=', 'cafe_branches.cafe_id');
        $list->join('indonesia_cities', 'cafe_branches.city_id', '=', 'indonesia_cities.id');
        $list->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id');
        if(isset($filter['province']) && $filter['province'] != 0) {
            $list->where('indonesia_provinces.id', '<=', $filter['province']);
            $province = $indonesia->findProvince($filter['province']);
        }
        if(isset($filter['city']) && $filter['city'] != 0) {
            $list->where('indonesia_cities.id', '<=', $filter['city']);
            if($filter['province'] === '') {
                $filter['province'] = $indonesia->findCity($filter['city'], ['province'])->province;
                $province = $indonesia->findProvince($filter['province']->id);
                $filter['province'] = $province;
            } else {
                $province = $indonesia->findProvince($filter['province']);
            }
        }
//        dd($province->name);
        $productList = $list->get();
        $city = $indonesia->findCity($filter['city'], ['province']);
        return view('product.list', compact('product', 'province', 'city', 'categories', 'productList', 'filter'));
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
            $product->hit = (int) $product->hit + 1;
            $product->save();
            $product->type = 'Menu';
        }
        if($code_item === "PKG"){
            $product = Package::find($productId);
            $product->type = 'Paket';
            // TODO Set Hit
        }
        $shop = Cafe::find($product->cafe_id);
        $reviews = Review::where('item_id', $productId)->orderBy('id', 'desc')->get();
        $topHit = TransactionDetail::getTopHitProducts();
        return view('product.detail', compact('shop', 'product', 'reviews', 'topHit'));
    }

}
