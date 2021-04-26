<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 100);
            $table->text('description');
            $table->enum('status', ['open', 'close'])->default('open');
            $table->string('address');
            $table->float('salary');
            $table->uuid('company_id');
            $table->uuid('recruiter_id');
            $table->timestamps();

            $table->foreign('recruiter_id')->references('id')->on('recruiters');
            $table->foreign('company_id')->references('id')->on('companies');
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
