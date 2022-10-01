<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_queries', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->string('name', 255)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('quantity', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->text('services')->nullable();
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
        Schema::dropIfExists('service_queries');
    }
}
