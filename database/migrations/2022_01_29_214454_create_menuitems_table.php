<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('menu_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('title_hidden')->nullable();
            $table->string('menu_type', '10')->nullable()->comment('horizontal,vertical');
            $table->string('url')->nullable();
            $table->string('sourch')->nullable();
            $table->string('location')->nullable();
            $table->string('target')->default("_self");
            $table->string('menu_width')->nullable();
            $table->integer('position')->nullable();
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
        Schema::dropIfExists('menuitems');
    }
}
