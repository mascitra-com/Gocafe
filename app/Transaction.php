<?php

namespace App;

use App\Http\Controllers\BranchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $fillable = ['id', 'branch_id', 'staff_id', 'table_number', 'production_cost', 'total_price', 'total_discount', 'total_payment', 'status', 'card_name', 'card_number'];

    use SoftDeletes;

    protected $table = 'transactions';

    public $incrementing = false;

    public static function getTableNotAvailable($branchId)
    {
        $table = DB::table('transactions')
            ->select('table_number')
            ->where('branch_id', $branchId)
            ->where('status', 0)
            ->get();
        return $table;
    }

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
