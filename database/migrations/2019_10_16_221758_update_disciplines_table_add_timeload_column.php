<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDisciplinesTableAddTimeloadColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('disciplines', 'timeload')) {
            Schema::table('disciplines', function (Blueprint $table) {
                $table->integer('timeload')->default(0);
            });
        }
    }
}
