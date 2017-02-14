<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCityIdAndProvinceIdAtCafeBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafe_branches', function (Blueprint $table) {
            $table->string('city');
            $table->dropColumn('city_id');
            $table->dropColumn('province_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafe_branches', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->integer('city_id')->unsigned()->index();
            $table->integer('province_id')->unsigned()->index();
        });
    }
}
