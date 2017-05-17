<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Cafe;
use App\Menu;
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
        $menus = $cafe->findOrFail($cafe->getCafeIdByUserIdNowLoggedIn())->menus->load('category');
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
        $requestData['cost'] = str_replace('.', '', $request->cost);
        $requestData['price'] = str_replace('.', '', $request->price);
        $request->merge($requestData);
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
        $images = explode(':', $menu->getattributes()['images_name']);
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
        $menus = Menu::where('category_id', $idCategory)->get();
        return response()->json(['success' => true, 'menus' => $menus]);
    }

    /**
     * @param $idMenu
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenu($idMenu)
    {
        $menu = Cafe::findOrFail(Cafe::getCafeIdByUserIdNowLoggedIn())->menus->where('id', $idMenu);
        return response()->json(['success' => true, 'menu' => $menu]);
    }

    /**
     * Show Thumbnail of Menu
     *
     * @param $id
     * @param Menu $menu
     * @return $this
     */
    public function showThumbnail($id, Menu $menu)
    {
        $thumbnail = $menu->getThumbnail($id, 'menus', 'menus');
        return Response($thumbnail[0], 200)->header('Content-Type', $thumbnail[1]);
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
