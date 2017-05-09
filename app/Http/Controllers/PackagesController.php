<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Menu;
use App\Cafe;
use Auth;

use Illuminate\Http\Response;

/**
 * Class PackagesController untuk Fitur Packages Management
 * @package App\Http\Controllers
 */
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::with('menus')->get();
        return view('package.package', compact('packages'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPackages()
    {
        $packages = Package::with('menus')->get();
        return response()->json(['success' => true, 'packages' => $packages]);
    }

    /**
     * @param $idPackage
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPackage($idPackage)
    {
        $package = Package::where('id', $idPackage)->get();
        return response()->json(['success' => true, 'package' => $package]);
    }


    /**
     * Display a package's image.
     *
     * @param $id
     * @param Package $package
     * @return Response
     */
    public function showImage($id, Package $package)
    {
        $avatar_instance = $package->getImage($id, 'packages', 'packages');
        return (new Response($avatar_instance[1], 200))->header('Content-Type', $avatar_instance[0]->mime);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn())->get();
        return view('package.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        //Add package
        $package_id = idWithPrefix(9);
        $request['id'] = $package_id;
        $request['cafe_id'] = Cafe::getCafeIdByUserIdNowLoggedIn();
        $request['created_by'] = Auth::user()->id;
        Package::create($request->except(['menus_id']));
        //Input current menus with inserted package's id
        $package = Package::find($package_id);
        return $package->menus()->attach($request['menus_id'], ['created_by' => $request['created_by']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Package $package
     * @internal param int $id
     */
    public function destroy(Package $package)
    {
        $package->menus()->detach();
        return $package->delete();
    }
}
