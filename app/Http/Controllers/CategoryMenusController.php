<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CategoryMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoryMenusController untuk Fitur Category Management
 * @package App\Http\Controllers
 */
class CategoryMenusController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Cafe::getCafeIdByUserIdNowLoggedIn()) {
            return redirect('profile/cafe')->with('status', 'Cafe Profile Must Be Filled!');
        }
        $categoryID = idWithPrefix(6);
        $categories = CategoryMenu::all()->where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn());
        $recommendedCat = DB::table('categories_menus')->select(DB::raw('distinct(name)'))->get();
        return view('menu.kategori', compact('categoryID', 'categories', 'recommendedCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cafe $cafe)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'colour' => 'required',
        ]);
        $category = new CategoryMenu($request->all());
        $cafe->addMenuCategory($category, Cafe::getCafeIdByUserIdNowLoggedIn());
        return redirect('categories')->with('status', 'Category Added!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Cafe $cafe
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, Cafe $cafe)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'colour' => 'required',
        ]);
        $category = new CategoryMenu($request->all());
        $newIdCategory = $cafe->addMenuCategory($category, Cafe::getCafeIdByUserIdNowLoggedIn());
        $newCategory = CategoryMenu::find($newIdCategory);
        return response()->json([
            'category_name' => $newCategory->name,
            'category_colour' => $newCategory->colour,
            'category_id' => $newIdCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'colour' => 'required',
        ]);
        CategoryMenu::findOrFail($id)->update($request->all());
        return redirect('categories')->with('status', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryMenu::destroy($id);
        return redirect('categories')->with('status', 'Category Deleted');
    }

    /**
     * Get all category according to cafe's id.
     *
     * @return \Illuminate\Http\Response json
     */
    public function getAllCategory()
    {
        $categories = CategoryMenu::all()->where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn());
        return response()->json($categories);
    }
}
