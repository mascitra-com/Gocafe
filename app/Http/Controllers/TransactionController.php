<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use App\Package;
use App\Review;
use App\Staff;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;

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
        $numberOfTables = CafeBranch::getNumberOfTablesByStaffNowLoggedIn();
        $table = $this->makeTableLayout($numberOfTables);
        return view('transaction.payment', compact('categories', 'menus', 'numberOfTables', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        // Get List of Category and All Menus from first Category
        $categories = CategoryMenu::all()->where('cafe_id', Staff::getCafeIdByStaffIdNowLoggedIn())->sortBy('name');
        $menus = Cafe::findOrFail(Staff::getCafeIdByStaffIdNowLoggedIn())->menus->where('category_id', $categories->first()->id);
        $firstMenu = $menus[0];
        $numberOfTables = CafeBranch::getNumberOfTablesByStaffNowLoggedIn();
        $packages = Package::where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn())->with('menus')->get();
        return view('transaction.order', compact('categories', 'menus', 'firstMenu', 'numberOfTables', 'reviews', 'packages'));
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
        $production_cost = 0;
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
                $production_cost += $menu->cost * $allAmount[$key];
                $total_price += $price = $menu->price * $allAmount[$key];
                $total_discount += $discount = $menu->discount * $menu->price * $allAmount[$key];
                $total_payment += ($price - $discount);
            }
            if($code_item === "PKG"){
                $package = Package::where('id', $value)->get();
                $details[$key]['id'] = idWithPrefix(11);
                $details[$key]['item_id'] = $package[0]->id;
                $details[$key]['amount'] = $allAmount[$key];
                $details[$key]['price'] = $package[0]->price;
                // Calculate All Total to store in Transaction Table
                $production_cost += $package[0]->cost * $allAmount[$key];
                $total_price += $price = $package[0]->price * $allAmount[$key];
                $total_discount += $discount = $package[0]->price * $allAmount[$key];
                $total_payment += $price;
            }
        }
        // Add Data to Store to Transaction Table
        $data['id'] = $transactionId;
        $data['created_by'] = 2;
        $data['total_price'] = $total_price;
        $data['total_discount'] = $total_discount;
        $data['production_cost'] = $production_cost;
        $data['total_payment'] = $total_payment;
        if($request->type){
            $data['status'] =  $request->type;
        }
        $request->request->add($data);
        $transaction = new Transaction($request->except(array('ids_menu', 'amount', 'cash_received', 'refund', 'type')));
        $staff->saveTransaction($transaction, Staff::getStaffIdNowLoggedIn());
        foreach ($details as $detail) {
            $transactionDetail = new TransactionDetail($detail);
            $staff->saveTransactionDetail($transactionDetail, $transactionId);
        }
        return back()->with('status', 'Transaction Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param $tableNumber
     * @return \Illuminate\Http\Response
     */
    public function getMenusByTableNumber($tableNumber)
    {
        // TODO Get BRANCH ID from Cafe BY STAFF ID Now Logged In
        if($transactionId = Transaction::where(array('table_number' => $tableNumber, 'status' => 0))->orderBy('created_at', 'desc')->first()){
            $items = TransactionDetail::where('transaction_id', $transactionId->id)->get();
            return response()->json(['transactionId' => $transactionId, 'items' => $items]);
        } else {
            return response()->json(['transactionId' => FALSE]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $itemId
     * @return \Illuminate\Http\Response
     */
    public function getReviewsByItemId($itemId)
    {
        $reviews = Review::where('item_id', $itemId)->orderBy('id', 'desc')->get();
        return response()->json(['reviews' => $reviews]);
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
     * @param Request $request
     * @param $transactionId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transactionId)
    {
        $transaction = Transaction::find($transactionId);
        $transaction->status = $request->type === 'cash' ? '1' : '-1'; // TODO Make This as Status Payment
        if($transaction->status == -1) {
            $transaction->card_name = $request->card_name;
            $transaction->card_number = $request->card_number;
        }
        $transaction->save();
        return redirect('payment')->with('status', 'Transaction Updated!');
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

    /**
     * Get Table that contains table
     *
     * @param $totalCell - Sum of Table
     * @return string
     */
    private function makeTableLayout($totalCell)
    {
        $tableNotAvailable = Transaction::getTableNotAvailable(CafeBranch::getBranchIdsByUserNowLoggedIn());
        $t = 0;
        $res = '<table width="200" border="1" class="table table-bordered"><tr>';
        for ($i = 1; $i <= $totalCell; $i++) {
            if(isset($tableNotAvailable[$t]) && $i === $tableNotAvailable[$t]->table_number){
                $td = '<td align="center" class="danger">';
                $t++;
            } else {
                $td = '<td align="center" class="success">';
            }
            if ($i % 5 == 0) $res .= $td . $i . '</td></tr><tr>';
            else {
                $res .= $td . $i . '</td>';
            }
        }
        return $res . '</table>';
    }

}
