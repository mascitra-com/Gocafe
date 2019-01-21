<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Menu;
use App\Owner;
use App\Package;
use App\Rating;
use App\Review;
use App\TransactionDetail;
use App\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Indonesia;

class ProductController extends Controller
{

    public function search()
    {
        $indonesia = new Indonesia();
        $filter['province'] = Input::get('province');
        $filter['city'] = Input::get('city');
        $filter['category'] = Input::get('category');
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

        $list->where(function ($c) {
            $query = explode(' ', Input::get('category'));
            foreach($query as $key => $element) {
                if($key == 0) {
                    $c->where('categories_menus.name', 'like', "%$element%");
                }
                $c->orWhere('categories_menus.name', 'like', "%$element%");
            }
        });
        $list->where('menus.deleted_at', NULL);
        $list->join('cafes', 'cafes.id', '=', 'menus.cafe_id');
        $list->join('categories_menus', 'categories_menus.id', '=', 'menus.category_id');
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
        $productList = $list->get();

        foreach ($productList as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
            $productList[$key]->thumbnail = $thumbnail;
        }
        $city = $indonesia->findCity($filter['city'], ['province']);
        return view('product.list', compact('product', 'province', 'city', 'categories', 'productList', 'filter'));
    }

    public function searchP($idProvince)
    {
        redirect('/search?&province=' . $idProvince);
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
        $thumbnail = Menu::getThumbnail($product->id);
        $thumbnail = str_replace('storage/product/', 'img/cache/large-product/', $thumbnail[0]);
        $product->thumbnail = $thumbnail;
        $shop = Cafe::find($product->cafe_id);
        $shop->logo = str_replace('storage/logo/', 'img/cache/tiny-logo/', Storage::url($shop->logo_path));
        $reviews = Review::where('item_id', $productId)->orderBy('id', 'desc')->get();
        foreach ($reviews as $key => $review) {
            $user = User::where('id', $review->created_by)->first();
            $reviews[$key]->avatar = str_replace('storage/owner/', 'img/cache/small-avatar/', Storage::url($user->avatar_name));
            $reviews[$key]->profile = Owner::where('user_id', $review->created_by)->first();
        }
        $topHit = TransactionDetail::getTopHitProducts();
        return view('product.detail', compact('shop', 'product', 'reviews', 'topHit'));
    }

    /**
     * @param Request $request
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function rate($productId)
    {
        if(!Auth::user()){
            return response()->json(0);
        }
        $rating = new Rating();
        $rating->user_id = Auth::id();
        $rating->user_role = Auth::user()->getTable();
        $rating->item_id = $productId;
        $rating->save();
        $menu = Menu::find($productId);
        $liked = intval($menu->liked) + 1;
        $menu->liked = $liked;
        $menu->save();
        session()->push('rated', $productId);
        return response()->json($liked);
    }
    /**
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function unRate($productId)
    {
        $rating = Rating::where('item_id', $productId)->first();
        $rating->delete();
        $menu = Menu::find($productId);
        $liked = intval($menu->liked) - 1;
        $menu->liked = $liked;
        $menu->save();
        $rated = session()->pull('rated');
        if(($key = array_search($productId, $rated)) !== false) {
            unset($rated[$key]);
        }
        session(['rated' => $rated]);
        return response()->json($liked);
    }

}
