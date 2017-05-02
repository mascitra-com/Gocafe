<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionDetail extends Model
{
    protected $fillable = ['id', 'transaction_id', 'item_id', 'amount', 'price', 'discount', 'created_by'];
    protected $table = 'transaction_details';

    public static function getFavouriteMenu($intervalMonth)
    {
        // Select Menu Group by ID order by Count of Aggrate Menu
        $top5menus = DB::table('transaction_details')
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(DB::raw('count(transaction_details.id) as total_order, transaction_details.item_id'))
            ->whereRaw("transactions.created_at >= (now() - interval $intervalMonth month)")
            ->whereIn('transactions.branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())
            ->groupBy('transaction_details.item_id')
            ->orderBy('total_order', 'desc')
            ->get();
        return $top5menus;
    }

    public static function getMenusOrderedPer30Days()
    {
        $menusPer30Days = TransactionDetail::join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->whereIn('transactions.branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())
            ->get();
        return $menusPer30Days;
    }
}
