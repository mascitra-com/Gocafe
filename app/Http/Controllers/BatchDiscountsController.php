<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Cafe;
use App\Menu;
use App\Package;

class BatchDiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cafe $cafe)
    {
        $menus = $cafe->findOrFail($cafe->getCafeIdByOwnerIdNowLoggedIn())->menus;
        $packages = $cafe->findOrFail($cafe->getCafeIdByOwnerIdNowLoggedIn())->packages;
        
        return view('discount.batch_discount', compact('menus', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function batch(Request $request)
    {
        $collect = new Collection($request->menus_id);
        $menus_id = $collect->toArray();
        // dd($menus_id[3]);

        //Separate menu's id & package's id
        $packages_id = array();
        $curr_menus_id = array();
        for ($i=0; $i <sizeof($menus_id); $i++) { 
            if (starts_with($menus_id[$i], "PKG")) {
                array_push($packages_id, $menus_id[$i]);
            }
        }
        for ($i=0; $i <sizeof($menus_id); $i++) { 
            if (starts_with($menus_id[$i], "MCF")) {
                array_push($curr_menus_id, $menus_id[$i]);
            }
        }

        $request->discount = $request->discount/100;

        if (sizeof($curr_menus_id)) {
            Menu::whereIn('id', $curr_menus_id)->update(['discount' => $request->discount]);
        }

        if (sizeof($packages_id)) {
            Package::whereIn('id', $packages_id)->update(['discount' => $request->discount]);
        }
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
}
