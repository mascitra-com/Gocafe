<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use App\Cafe;
use Auth;

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
    public function store(Request $request)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'value' => 'required',
        ]);

        if (empty($request->start_date)) {
            $request['start_date'] = time();
        }else{
            $request['start_date'] = date('Y-m-d', strtotime($request->start_date));
        }

        if (!empty($request->expired_date)) {
            $request['expired_date'] = date('Y-m-d', strtotime($request->expired_date));
        }

        $request['value'] = $request->value / 100;

        $request->merge(array(
            'id' => idWithPrefix(8),
            'created_by' => Auth::user()->id
        ));

        Discount::create($request->all());

        return redirect('discount')->with('status', 'Discount Added!');
    }
}
