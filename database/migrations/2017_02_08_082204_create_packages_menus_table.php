<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_menus', function (Blueprint $table) {
            $table->string('id', 20);
            $table->string('menu_id', 20)->index();
            $table->string('package_id', 20)->index();
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
        Schema::dropIfExists('packages_menus');
    }
}
