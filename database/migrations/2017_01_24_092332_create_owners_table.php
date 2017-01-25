<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->integer('user_id')->unsigned()->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->enum('gender', ['0', '1']);
            $table->date('birthdate');
            $table->string('phone', 20);
            $table->timestamps();
            $table->integer('created_by')->unsigned()->index();
            $table->integer('updated_by')->unsigned()->index();
            $table->integer('deleted_by')->unsigned()->index();
            $table->softDeletes();
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
