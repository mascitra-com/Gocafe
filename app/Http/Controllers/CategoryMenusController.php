<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cafe;
use App\CategoryMenu;

class CategoryMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryID = idWithPrefix(6);
        $categories = CategoryMenu::all()->where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn());
        return view('menu.kategori', compact('categoryID', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $cafe->addMenuCategory($category, Cafe::getCafeIdByOwnerIdNowLoggedIn());
        return redirect('categories')->with('status', 'Category Added!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $newIdCategory = $cafe->addMenuCategory($category, Cafe::getCafeIdByOwnerIdNowLoggedIn());
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryMenu::destroy($id);
        redirect('categories')->with('status', 'Category Deleted');
    }

     /**
     * Get all category according to cafe's id.
     *
     * @return \Illuminate\Http\Response json
     */
     public function getAllCategory()
     {
        $categories = CategoryMenu::all()->where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn());

        return response()->json($categories);

    }
}
