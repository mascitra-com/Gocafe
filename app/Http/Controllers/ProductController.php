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
        $filter['location'] = Input::get('location');
        $filter['orderBy'] = Input::get('order');
        $filter['lowPrice'] = str_replace('.', '', Input::get('lowPrice'));
        $filter['highPrice'] = str_replace('.', '', Input::get('highPrice'));
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
        $list->join('cafes', 'cafes.id', '=', 'menus.cafe_id');
        $list->join('cafe_branches', 'cafes.id', '=', 'cafe_branches.cafe_id');
        $list->join('indonesia_cities', 'cafe_branches.city_id', '=', 'indonesia_cities.id');
        if($filter['location']) {
            $list->where('indonesia_cities.id', '<=', $filter['location']);
        }
        $productList = $list->get();
        $indonesia = new Indonesia();
        $location = $indonesia->findCity($filter['location']);
        return view('product.list', compact('product', 'location', 'categories', 'productList', 'filter'));
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
