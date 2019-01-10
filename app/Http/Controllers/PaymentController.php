<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use App\Staff;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (Auth::user()->role == 'owner') {
            exit('Halaman Tidak Tersedia');
        } else {
            $cafeId = Staff::getCafeIdByStaffIdNowLoggedIn();
        }
        // Get List of Category and All Menus from first Category
        $categories = CategoryMenu::all()->where('cafe_id', Staff::getCafeIdByStaffIdNowLoggedIn())->sortBy('name');
        $menus = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories->first()->id);
        foreach ($menus as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
            $menus[$key]->thumbnail = $thumbnail;
        }
        $numberOfTables = CafeBranch::getNumberOfTablesByStaffNowLoggedIn();
        $table = $this->makeTableLayout($numberOfTables);

        return view('transaction.payment', compact('categories', 'menus', 'numberOfTables', 'table'));
        // return "hy";
    }

    /**
     * Get Table that contains table
     *
     * @param $totalCell - Sum of Table
     *
     * @return string
     */
    private function makeTableLayout($totalCell)
    {
        $tableNotAvailable = Transaction::getTableNotAvailable(CafeBranch::getBranchIdsByUserNowLoggedIn())->toArray();
        $t = 0;
        $tableNotAvailable = array_column($tableNotAvailable, 'table_number');
        $res = '<table width="200" border="1" class="table table-bordered"><tr>';
        for ($i = 1; $i <= $totalCell; $i++) {
            if (isset($tableNotAvailable[$t]) && in_array($i, $tableNotAvailable)) {
                $td = '<td align="center" class="danger">';
                $t++;
            } else {
                $td = '<td align="center" class="success">';
            }
            if ($i % 5 == 0) {
                $res .= $td . $i . '</td></tr><tr>';
            } else {
                $res .= $td . $i . '</td>';
            }
        }

        return $res . '</table>';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $transactionId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transactionId)
    {
        $transaction = Transaction::find($transactionId);
        $transaction->status = $request->type == 'cash' ? '1' : '-1'; // TODO Make This as Status Payment
        if ($transaction->status == -1) {
            $transaction->card_name = $request->card_name;
            $transaction->card_number = $request->card_number;
        }
        $transaction->save();

        return redirect('payment')->with('status', 'Transaction Updated!');
    }

    public function detail($id)
    {
        $transaction = Transaction::where('id', $id)->get();

        return response()->json(['transaction' => $transaction]);
    }
}
