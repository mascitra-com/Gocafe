<?php

namespace App;

use App\Http\Controllers\BranchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $fillable = ['id', 'branch_id', 'staff_id', 'table_number', 'production_cost', 'total_price', 'total_discount', 'total_payment', 'status', 'card_name', 'card_number'];

    use SoftDeletes;

    protected $table = 'transactions';

    public $incrementing = false;

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function branch()
    {
        return $this->belongsTo(CafeBranch::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

}
