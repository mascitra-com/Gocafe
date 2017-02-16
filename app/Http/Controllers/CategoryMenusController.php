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
        $category = new CategoryMenu($request->all());
        $category_id = $cafe->addMenuCategory($category, Cafe::getCafeIdByOwnerIdNowLoggedIn());
        
        return response()->json(['response' => 'inserted','category_id' => $category_id,'category_name' => $request->name,'category_colour' => $request->colour ,'status' => TRUE]);
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
        //
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
