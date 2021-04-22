<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('id_recruiters_creator');
            $table->string('title');
            $table->text('description');
            $table->char('status', 1)->default('O');//O=Open, C=Closed
            $table->text('address');
            $table->decimal('salary', 10, 2);
            $table->string('company');
            $table->timestamps();

            $table->foreign('id_recruiters_creator')
                ->references('id')
                ->on('recruiters');
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
