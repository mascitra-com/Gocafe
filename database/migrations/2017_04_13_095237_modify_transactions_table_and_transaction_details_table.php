<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTransactionsTableAndTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->integer('table_number')->after('id_staff')->unsigned()->index();
            $table->tinyInteger('status')->after('total_payment')->index();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->integer('deleted_by')->unsigned()->index()->nullable();
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->integer('deleted_by')->unsigned()->index()->nullable();
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
