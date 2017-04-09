<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cafe;
use App\CategoryMenu;
use App\Menu;

/**
 * Class MenusController untuk Fitur Menu Management
 * @package App\Http\Controllers
 */
class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function index(Cafe $cafe)
    {
        $menus = $cafe->findOrFail($cafe->getCafeIdByOwnerIdNowLoggedIn())->menus->load('category');
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
        $categories = $cafe->findOrFail($cafe->getCafeIdByOwnerIdNowLoggedIn())->menuCategories;
        return view('menu.create', compact('categories'));
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
        ]);
        $images_name = "";
        $mime = "";
        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                if ($request->file('image' . $i)->isValid()) {
                    $image_name = idWithPrefix(0);
                    $image_mime = $request->file('image' . $i)->getClientMimeType();
                    //store to storage/app/menus
                    $request->file('image' . $i)->storeAs('menus', $image_name, 'menus');
                    //add current image_name to images_name array
                    $images_name .= $image_name . ":";
                    $mime .= $image_mime . ":";
                } else {
                    echo "file image" . $i . " tidak valid <br>";
                }
            } else {
                $images_name .= 'default:';
                $mime .= 'image/jpeg:';
            }
        }
        //manage requests
        $request->request->add(array(
            'images_name' => $images_name,
            'mime' => $mime
        ));
        //insert to menus table
        $menu = new Menu($request->except('category_name', 'image1', 'image2', 'image3', 'image4'));
        $cafe->addMenu($menu, Cafe::getCafeIdByOwnerIdNowLoggedIn());
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
        $menu = Cafe::findOrFail(Cafe::getCafeIdByOwnerIdNowLoggedIn())->menus->find($menu->id)->load('category');
        $categories = Cafe::findOrFail(Cafe::getCafeIdByOwnerIdNowLoggedIn())->menuCategories;
        return view('menu.create', compact('menu', 'categories'));
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
        Cafe::findOrFail(Cafe::getCafeIdByOwnerIdNowLoggedIn())->menus->find($menu->id)->update(($request->except(['category_name', 'image1', 'image2', 'image3', 'image4'])));
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
        Menu::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->find($id)->delete();
        return redirect('categories')->with('status', 'Menu Deleted');
    }
}
