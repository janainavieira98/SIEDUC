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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday');
            $table->string('rg');
            $table->string('cpf');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('phone_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();

            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses');

            $table->foreign('phone_id')
                ->references('id')
                ->on('phones');

            $table->foreign('gender_id')
                ->references('id')
                ->on('genders');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
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
