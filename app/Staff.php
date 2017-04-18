<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staffs';

	public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'user_id', 'position_id', 'branch_id','gender', 'birthdate', 'first_name', 'last_name', 'address','phone', 'created_by'];    

    protected $hidden = ['id', 'user_id', 'position_id', 'branch_id', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * Get Staff ID by User ID currently logged in
     *
     * @return Owner ID
     */
    public static function getStaffIdNowLoggedIn()
    {
        return DB::table('staffs')->where('user_id', Auth::user()->id)->first()->id;
    }

    /**
     * Get Cafe Branch ID by Staff ID currently logged in
     *
     * @return Owner ID
     */
    public static function getCafeBranchIdNowLoggedIn()
    {
        return DB::table('staffs')->where('user_id', Auth::user()->id)->first()->branch_id;
    }

    /**
     * Get Cafe Branch ID by Staff ID currently logged in
     *
     * @return Owner ID
     */
    public static function getCafeIdByStaffIdNowLoggedIn()
    {
        return DB::table('cafe_branches')->where('id', Staff::getCafeBranchIdNowLoggedIn())->first()->cafe_id;
    }

    public function saveTransaction(Transaction $transaction, $staffId)
    {
        $transaction->branch_id = Staff::getCafeBranchIdNowLoggedIn();
        $transaction->created_by = Auth::user()->id;
        Staff::find($staffId)->transaction()->save($transaction);
    }

    public function saveTransactionDetail(TransactionDetail $transactionDetail, $transactionId)
    {
        $transactionDetail->created_by = Auth::user()->id;
        Transaction::find($transactionId)->details()->save($transactionDetail);
    }

    //RELATIONS
    public function transaction()
    {
    	return $this->hasMany(Transaction::class);
    }

    public function position()
    {
    	return $this->belongsTo(Position::class);
    }
    
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
    
    public function branches()
    {
    	return $this->belongsTo(CafeBranch::class, 'branch_id');
    }

}
