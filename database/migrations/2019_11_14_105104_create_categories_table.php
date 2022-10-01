<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->string('category_bd', 75)->nullable();
            $table->string('category_en', 75)->nullable();
            $table->string('slug', 75);
            $table->string('cat_slug_en', 75);
            $table->string('type', 15);
            $table->integer('position')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
