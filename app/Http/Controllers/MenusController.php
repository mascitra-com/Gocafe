<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cafe;
use App\CategoryMenu;
use App\Menu;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cafe $cafe, CategoryMenu $categories)
    {
        $menus = $cafe->findOrFail($cafe->getCafeIdByOwnerIdNowLoggedIn())->menus->load('category');
        // return dd($menus);
        return view('menu.menu', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cafe $cafe)
    {
        $images_name= "";
        $mime= "";
        for ($i=1; $i <=4 ; $i++) { 
            if ($request->hasFile('image'.$i)) {
                if ($request->file('image'.$i)->isValid()) {
                    $image_name = idWithPrefix(0);
                    $image_mime = $request->file('image'.$i)->getClientMimeType();

                    //store to storage/app/menus
                    $request->file('image'.$i)->storeAs('menus', $image_name, 'menus');
                    
                    //add current image_name to images_name array
                    $images_name.=$image_name.":";
                    $mime.=$image_mime.":";
                }else{
                    echo "file image".$i." tidak valid <br>";
                }
            }else{
                $images_name.='default:';
                $mime.='image/jpeg:';
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->find($id)->delete();
        redirect('categories')->with('status', 'Menu Deleted');
    }
}
