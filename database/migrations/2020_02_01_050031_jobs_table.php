<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table){
           $table->increments('id');
           $table->string('title', 256);
           $table->text('description');
           $table->enum('status', ['enable', 'disable']);
           $table->json('workplace')->nullable();
           $table->double('salary', 15,2)->nullable();
           $table->timestamps();
           $table->softDeletes();
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
