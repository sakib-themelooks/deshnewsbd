<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('news_title');
            $table->text('news_slug');
            $table->longText('news_dsc')->nullable();
            $table->string('category', 255);
            $table->string('categories', 255);
            $table->integer('subcategory')->nullable();
            $table->integer('childcategory')->nullable();
            $table->string('location', 255)->nullable();
            $table->integer('division')->nullable();
            $table->integer('zilla')->nullable();
            $table->integer('upzilla')->nullable();
            $table->timestamp('publish_date');
            $table->string('sub_1', 255)->nullable();
            $table->string('sub_2', 255)->nullable();
          
            $table->string('thumb_image', 255)->nullable();
            $table->string('thumb_url', 255)->nullable();
           
            $table->string('type', 25)->nullable();
            $table->string('news_type', 25)->nullable();
            $table->string('lang', 5)->nullable();
            $table->text('attach_files')->nullable();
            $table->tinyInteger('breaking_news')->nullable();
            $table->tinyInteger('feature_news')->nullable();
            $table->tinyInteger('schedule_news')->nullable();
            $table->integer('impressions')->default(0);
            $table->integer('view_counts')->default(0);
            
            $table->text('meta_title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('reject_reason')->nullable(0);
            $table->integer('activation')->default(0);
            $table->string('status', 10)->default('pending');
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
        Schema::dropIfExists('news');
    }
}
