<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomWeekdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_weekday', function (Blueprint $table) {
            $table->unsignedBigInteger('classroom_id');
            $table->string('weekday_slug');

            $table->primary(['classroom_id', 'weekday_slug']);
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onDelete('cascade');
            $table->foreign('weekday_slug')
                ->references('slug')
                ->on('weekdays')
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
        Schema::dropIfExists('classroom_weekday');
    }
}
