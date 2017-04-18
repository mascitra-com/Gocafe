<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Staff;
use App\Transaction;
use App\CategoryMenu;
use App\Cafe;
use App\TransactionDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        // Get List of Category and All Menus from first Category
        $categories = CategoryMenu::all()->where('cafe_id', Staff::getCafeIdByStaffIdNowLoggedIn())->sortBy('name');
        $menus = Cafe::findOrFail(Staff::getCafeIdByStaffIdNowLoggedIn())->menus->where('category_id', $categories->first()->id);
        return view('transaction.payment', compact('categories', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        return view('transaction.order');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Staff $staff)
    {
        // Get Items and calculate the total price
        $total_price = 0;
        $total_discount = 0;
        $total_payment = 0;
        $allId = $request->ids_menu;
        $allAmount = $request->amount;
        $transactionId = idWithPrefix(10);
        $details = array();
        foreach ($allId as $key => $value){
            $code_item = substr($value, 0,3);
            if($code_item === "MCF"){
                $menu = Menu::find($value);
                $details[$key]['id'] = idWithPrefix(11);
                $details[$key]['item_id'] = $menu->id;
                $details[$key]['amount'] = $allAmount[$key];
                $details[$key]['price'] = $menu->price;
                $details[$key]['discount'] = $menu->discount;
                // Calculate All Total to store in Transaction Table
                $total_price += $price = $menu->price * $allAmount[$key];
                $total_discount += $discount = $menu->discount * $menu->price * $allAmount[$key];
                $total_payment += ($price - $discount);
            }
        }
        // Add Data to Store to Transaction Table
        $data['id'] = $transactionId;
        $data['created_by'] = 2;
        $data['table_number'] = '23'; // TODO Make This Dynamic
        $data['total_price'] = $total_price;
        $data['total_discount'] = $total_discount;
        $data['total_payment'] = $total_payment;
        $data['status'] = $request->type === 'cash' ? '0' : '1'; // TODO Make This as Status Payment

        $request->request->add($data);
        $transaction = new Transaction($request->except(array('ids_menu', 'amount', 'cash_received', 'refund', 'type')));
        $staff->saveTransaction($transaction, Staff::getStaffIdNowLoggedIn());
        foreach ($details as $detail) {
            $transactionDetail = new TransactionDetail($detail);
            $staff->saveTransactionDetail($transactionDetail, $transactionId);
        }
        return redirect('payment')->with('status', 'Transaction Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
