<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('discipline_id');
            $table->unsignedBigInteger('user_id');
            $table->string('grade1')->nullable();
            $table->string('grade2')->nullable();
            $table->string('grade3')->nullable();
            $table->string('grade4')->nullable();
            $table->string('absences1')->nullable();
            $table->string('absences2')->nullable();
            $table->string('absences3')->nullable();
            $table->string('absences4')->nullable();
            $table->boolean('approved')->nullable();
            $table->timestamps();

            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onDelete('cascade');

            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('grades');
    }
}
