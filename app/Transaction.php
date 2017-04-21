<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $fillable = ['id', 'branch_id', 'staff_id', 'table_number', 'total_price', 'total_discount', 'total_payment', 'status', 'credit_card_name', 'credit_card_number'];

    use SoftDeletes;

    protected $table = 'transactions';

    public $incrementing = false;

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
