<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DromOwnerIdColumnAtCafeBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafe_branches', function (Blueprint $table) {
            $table->dropColumn('owner_id');
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
            $table->string('owner_id')->nullable()->after('cafe_id')->index();
        });
    }
}
