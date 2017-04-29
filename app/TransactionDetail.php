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
            ->select(DB::raw('count(id) as total_order, item_id'))
            ->whereRaw("created_at >= (now() - interval $intervalMonth month)")
            ->groupBy('item_id')
            ->orderBy('total_order', 'desc')
            ->get();
        return $top5menus;
    }
}
