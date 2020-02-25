<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('company');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['active', 'inactive']);
            $table->string('workplace')->nullable();
            $table->decimal('salary', 10,2)->nullable();
            $table->string('contact');
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
        Schema::dropIfExists('jobs');
    }
}
