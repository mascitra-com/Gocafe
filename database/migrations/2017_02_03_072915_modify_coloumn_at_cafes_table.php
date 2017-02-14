<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColoumnAtCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('cafes', function (Blueprint $table) {
            $table->string('facebook')->nullable()->change();
            $table->string('twitter')->nullable()->change();
            $table->string('instagram')->nullable()->change();
            $table->string('phone', 20)->nullable()->change();
            $table->dropColumn('open_hours');
            $table->dropColumn('close_hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafes', function (Blueprint $table) {
            //
        });
    }
}
