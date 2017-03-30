<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Menu;
use App\Cafe;
use Auth;

use Illuminate\Http\Response;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('package.package', compact('packages'));
    }

    /**
     * Display a package's image.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImage($id, Package $package)
    {
        $avatar_instance = $package->getImage($id, 'packages', 'packages');

        return (new Response($avatar_instance[1], 200))
        ->header('Content-Type', $avatar_instance[0]->mime);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->get();

        return view('package.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Add package
        $package_id = idWithPrefix(9);
        $request['id'] = $package_id;
        $request['cafe_id'] = Cafe::getCafeIdByOwnerIdNowLoggedIn();
        $request['created_by'] = Auth::user()->id;
        
        // dd($request->all());

        Package::create($request->except(['menus_id']));

        //Input current menus with inserted package's id
        $package = Package::find($package_id);
        $package->menus()->attach($request['menus_id'], ['created_by' => $request['created_by']]);
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
