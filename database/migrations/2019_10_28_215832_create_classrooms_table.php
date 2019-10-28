<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('grade');
            $table->string('description');
            $table->string('period_slug');
            $table->string('start_hour');
            $table->string('end_hour');
            $table->year('year');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('max_users')->default(40);
            $table->timestamps();

            $table->foreign('period_slug')
                ->references('slug')
                ->on('periods')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
