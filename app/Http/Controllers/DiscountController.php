<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use App\Cafe;
use Auth;

/**
 * Class DiscountController untuk Fitur Promotion Management
 * @package App\Http\Controllers
 */
class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('discount.discount', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cafe $cafe)
    {
        return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param Discount $discount
     */
    public function store(Request $request)
    {
        // Validate the required data
        $this->validate($request, [
            'name' => 'min:3|max:255|required',
            'value' => 'required',
        ]);
        $request = $this->customize_request_data($request);
        $request->merge(array(
            'id' => idWithPrefix(8),
            'created_by' => Auth::user()->id
        ));
        Discount::create($request->all());
        return redirect('discount')->with('status', 'Discount Added!');
    }

    /**
     * @param Request $request
     * @return Request
     */
    private function customize_request_data(Request $request)
    {
        if (empty($request->start_date)) {
            $request['start_date'] = date('Y-m-d');
        } else {
            $request['start_date'] = date('Y-m-d', strtotime($request->start_date));
        }
        if (!empty($request->expired_date)) {
            $request['expired_date'] = date('Y-m-d', strtotime($request->expired_date));
        } else {
            $request['expired_date'] = NULL;
        }
        $request['value'] = $request->value / 100;
        $request['cafe_id'] = Cafe::getCafeIdByOwnerIdNowLoggedIn();
        return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        return view('discount.detail', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Discount $discount
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Discount $discount)
    {
        $request = $this->customize_request_data($request);
        Discount::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->find($discount->id)->update(($request->all()));
        return redirect('discount')->with('status', 'Discount Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->find($id)->delete();
        return redirect('discount')->with('status', 'Discount Deleted');
    }

    /**
     * Deactivate specific discount immediately
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivate($id)
    {
        $yesterday = date('Y-m-d', strtotime('-1 days'));;
        Discount::where('cafe_id', Cafe::getCafeIdByOwnerIdNowLoggedIn())->find($id)->update(array('expired_date' => $yesterday));
        return redirect('discount')->with('status', 'Discount Deactivated');
    }
}
