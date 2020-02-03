<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobsAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_applies', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('job_id')->unsigned();
            $table->primary(['user_id', 'job_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('jobs_applies');
        Schema::enableForeignKeyConstraints();
    }
}
