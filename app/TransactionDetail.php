<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = ['id', 'transaction_id', 'item_id', 'amount', 'price', 'discount', 'created_by'];
    protected $table = 'transaction_details';
}
