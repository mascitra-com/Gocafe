<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use App\Cafe;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discount.discount');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cafe $cafe)
    {
        $menus = $cafe->findOrFail($cafe->getCafeIdByOwnerIdNowLoggedIn())->menus->load('category');
        return view('discount.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Discount $discount)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'colour' => 'required',
        ]);
        return redirect('categories')->with('status', 'Category Added!');
    }
}
