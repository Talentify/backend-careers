<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyTbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vacancy_tb', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('description', 1000);
            $table->string('address', 200);
            $table->string('salary', 100);
            $table->string('company', 100);
            $table->Integer('status');
            $table->bigInteger('recruiter_id')->unsigned();
            $table->foreign('recruiter_id')->references('id')->on('users');
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
        Schema::dropIfExists('vacancy_tb');
    }
}
