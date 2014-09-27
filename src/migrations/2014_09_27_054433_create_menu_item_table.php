<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_item', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('parent_id')->default(0);
            $table->string('title');
            $table->string('url');
            $table->string('filter')->nullable();
            $table->integer('order');
            $table->text("properties")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_item');
    }

}