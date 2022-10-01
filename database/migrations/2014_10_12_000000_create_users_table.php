<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role_id', 15);
            $table->string('name', 75);
            $table->string('username', 75);
            $table->text('user_dsc')->nullable();
            $table->string('gender' ,6)->nullable();
            $table->string('birthday')->nullable();
            $table->string('blood')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('mobile_verification_token')->nullable();
            $table->string('email', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->string('password');
            $table->string('provider', 15)->nullable();
            $table->string('provider_id', 255)->nullable();
            $table->decimal('wallet_balance')->default(0.00);
           
            $table->string('photo', 225)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('activation');
            $table->string('status', 10);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
