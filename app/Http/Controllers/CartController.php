<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Cart;
use App\CartItems;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'id_user' => Auth::id()
        ]);
        $cart_items = CartItems::select('item_id')->where('cart_id', $cart->id)->get();
        $items = $cart_items->map(function ($item) {
            return $item->item_id;
        });
        $cafes = Cafe::select('id', 'name')->whereHas('menus', function ($query) use ($items){
            $query->whereIn('id', $items);
        })->get();
        $key = 1;
        foreach ($cafes as $cafeKey => $cafe) {
            $cafes[$cafeKey]->key = $cafeKey + 1;
            $cafe->items = CartItems::with('menu:id,name,price')->select('cafe_id', 'item_id', 'amount')->where(['cart_id' => $cart->id, 'cafe_id' => $cafe->id])->get();
            $cafes[$cafeKey]->total = 0;
            foreach ($cafe->items as $itemKey => $item) {
                $cafe->items[$itemKey]->key = $key++;
                $thumbnail = Menu::getThumbnail($item->item_id);
                $cafe->items[$itemKey]->thumbnail = str_replace('storage/product/', 'img/cache/large-product/', $thumbnail[0]);
                $cafe->items[$itemKey]->total = $item->menu->price * $item->amount;
                $cafes[$cafeKey]->total += $cafe->items[$itemKey]->total;
            }
        }
        return view('cart.index', compact('cafes'));
    }

    public function store(Request $request)
    {
        $cart = Cart::firstOrCreate([
            'id_user' => Auth::id()
        ]);

        $menu = Menu::where('id', $request->item)->first();
        $item = CartItems::firstOrNew([
            'cart_id' => $cart->id,
            'cafe_id' => $menu->cafe_id,
            'item_id' => $request->item,
        ]);
        $item->amount = $request->amount;
        $item->save();

        $total = 0;
        $cart_items = CartItems::with('menu:id,cafe_id,name,price')->select('item_id', 'amount')->where(['cart_id' => $cart->id])->get();
        foreach ($cart_items as $item) {
            $total += $item->menu->price * $item->amount;
        }
        return ['total' => $total];
    }

    public function modal()
    {
        $cart = Cart::select('id')->where(['id_user' => Auth::id()])->first();
        $items = CartItems::with('menu:id,name,price')->select('cafe_id', 'item_id', 'amount')->where(['cart_id' => $cart->id])->get();
        $list = '';
        foreach ($items as $itemKey => $item) {
            $item->key = $itemKey + 1;
            $item->name = $item->menu->name;
            $item->shop = Cafe::select('name')->where('id', $item->cafe_id)->first();
            $thumbnail = Menu::getThumbnail($item->item_id);
            $item->thumbnail = str_replace('storage/product/', 'img/cache/large-product/', $thumbnail[0]);
            $item->price = $item->menu->price;
            $item->total = $item->menu->price * $item->amount;
            $list .= view('cart.cart-item', compact('item'));
        }
        return $list;
    }
}
