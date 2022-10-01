<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeshjuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deshjures', function (Blueprint $table) {
            $table->id();
            $table->char('name_bd', 25);
            $table->char('name_en', 25)->nullable();
            $table->char('slug', 25);
            $table->integer('parent_id')->nullable();
            $table->string('cat_type', 15);
            $table->integer('position')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('deshjures');
    }
}
