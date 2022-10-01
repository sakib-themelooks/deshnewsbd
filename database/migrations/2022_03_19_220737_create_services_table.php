<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image', 255)->nullable();
            $table->tinyInteger('is_default')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('services');
    }
}
