<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->string('id', 20);
            $table->string('cafe_id', 20)->index();
            $table->string('name');
            $table->text('description');
            $table->double('price');
            $table->string('images_name');
            $table->string('mime')->default('image/jpeg');
            $table->integer('created_by')->unsigned()->index();
            $table->integer('updated_by')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('menus');
    }
}
