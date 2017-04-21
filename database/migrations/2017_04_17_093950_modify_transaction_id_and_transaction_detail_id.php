<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTransactionIdAndTransactionDetailId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->string('id', 20)->index();
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->string('id', 20)->index();
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
