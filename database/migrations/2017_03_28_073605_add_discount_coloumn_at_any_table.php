<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountColoumnAtAnyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::table('menus', function (Blueprint $table) {
        $table->float('discount')->nullable();
    });

     Schema::table('packages', function (Blueprint $table) {
        $table->float('discount')->nullable();
    });
 }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('discount');
        });

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}
