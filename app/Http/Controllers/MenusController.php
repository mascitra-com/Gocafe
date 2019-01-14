<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class MenusController untuk Fitur Menu Management
 * @package App\Http\Controllers
 */
class MenusController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function index(Cafe $cafe)
    {
        if (!Cafe::getCafeIdByUserIdNowLoggedIn()) {
            return redirect('profile/cafe')->with('status', 'Cafe Profile Must Be Filled!');
        }
        if (!CafeBranch::getBranchIdsByUserNowLoggedIn()) {
            return redirect('branch')->with('status', 'You must have Cafe Branch at least one!');
        }
        $menus = $cafe->findOrFail($cafe->getCafeIdByUserIdNowLoggedIn())->menus->load('category');
        foreach ($menus as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/tiny-product/', $thumbnail[0]);
            $menus[$key]->thumbnail = $thumbnail;
        }
        return view('menu.menu', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function create(Cafe $cafe)
    {
        $categories = $cafe->findOrFail($cafe->getCafeIdByUserIdNowLoggedIn())->menuCategories;
        $recommendedCat = DB::table('categories_menus')->select(DB::raw('distinct(name)'))->get();
        return view('menu.create', compact('categories', 'recommendedCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cafe $cafe)
    {
        // Validate the required data
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'min:3|max:255|required',
            'description' => 'required',
            'price' => 'required',
            'halal' => 'required',
        ]);
        $requestData['cost'] = str_replace('.', '', $request->cost);
        $requestData['price'] = str_replace('.', '', $request->price);
        $request->merge($requestData);
        $images = "";
        $mime = "";
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                if ($request->file('image' . $i)->isValid()) {
                    $path = $request->file('image' . $i)->store('product', 'product');
                    $images .= "$path:";
                } else {
                    echo "file image" . $i . " tidak valid <br>";
                }
            } else {
                $images .= 'default:';
            }
        }
        //manage requests
        $request->request->add(array(
            'images' => $images
        ));
        //insert to menus table
        $menu = new Menu($request->except('category_name', 'image1', 'image2', 'image3', 'image4'));
        $cafe->addMenu($menu, Cafe::getCafeIdByUserIdNowLoggedIn());
        return redirect('menus')->with('status', 'Menu Added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Menu $menu)
    {
        $menu = Cafe::findOrFail(Cafe::getCafeIdByUserIdNowLoggedIn())->menus->find($menu->id)->load('category');
        $images = explode(':', $menu->getattributes()['images']);
        foreach ($images as $key => $value) {
            $images[$key] = str_replace('storage/product/', 'img/cache/small-product/', Storage::url($value));
        }
        $categories = Cafe::findOrFail(Cafe::getCafeIdByUserIdNowLoggedIn())->menuCategories;
        return view('menu.create', compact('menu', 'categories', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Menu $menu)
    {
        $requestData['cost'] = str_replace('.', '', $request->cost);
        $requestData['price'] = str_replace('.', '', $request->price);
        $request->merge($requestData);
        $menu = Cafe::findOrFail(Cafe::getCafeIdByUserIdNowLoggedIn())->menus->find($menu->id)->load('category');
        $temp = explode(':', $menu->getattributes()['images']);
        $images = "";
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                if ($request->file('image' . $i)->isValid()) {
                    $path = $request->file('image' . $i)->store('product', 'product');
                    $images .= "$path:";
                    if($exists = Storage::disk('product')->exists('public/' . $temp[$i-1]))
                        Storage::delete('public/'. $temp[$i-1]);
                } else {
                    echo "file image" . $i . " tidak valid <br>";
                }
            } else {
                $images .= $temp[$i-1] . ':';
            }
        }
        //manage requests
        $request->request->add(array(
            'images' => $images,
        ));
        Cafe::findOrFail(Cafe::getCafeIdByUserIdNowLoggedIn())->menus->find($menu->id)->update(($request->except(['category_name', 'image1', 'image2', 'image3', 'image4'])));
        return redirect('menus')->with('status', 'Menu Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn())->find($id)->delete();
        return redirect('categories')->with('status', 'Menu Deleted');
    }

    /**
     * @param $idCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenus($idCategory)
    {
        if($idCategory) {
            $menus = Menu::where('category_id', $idCategory)->get();
            foreach ($menus as $key => $value) {
                $thumbnail = Menu::getThumbnail($value->id);
                $thumbnail = str_replace('storage/product/', 'img/cache/tiny-product/', $thumbnail[0]);
                $menus[$key]->thumbnail = $thumbnail;
            }
        }
        return response()->json(['success' => true, 'menus' => $menus]);
    }

    /**
     * @param $idMenu
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenu($idMenu)
    {
        $menu = Menu::where('id', $idMenu)->get();
        $thumbnail = Menu::getThumbnail($menu[0]->id);
        $thumbnail = str_replace('storage/product/', 'img/cache/large-product/', $thumbnail[0]);
        $menu[0]->thumbnail = $thumbnail;
        return response()->json(['success' => true, 'menu' => $menu]);
    }

    /**
     * Show Thumbnail of Menu
     *
     * @param $image_file
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function showImage($image_file)
    {
        $image = Storage::disk('menus')->get('menus/'.$image_file);
        return Response($image, 200);
    }
}
