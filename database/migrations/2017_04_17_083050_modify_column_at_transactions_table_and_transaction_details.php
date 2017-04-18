<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnAtTransactionsTableAndTransactionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('id_branches', 'branch_id');
            $table->renameColumn('id_staff', 'staff_id');
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->renameColumn('id_transaction', 'transaction_id');
            $table->renameColumn('id_item', 'item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
