<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsOpportunitiesDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_opportunities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign("company_id")
                ->references("id")
                ->on("companies")
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string("title", 256)->index("title");
            $table->string("description", 10000);
            $table->enum("status", [
                "active",
                "inactive"
            ]);
            $table->decimal("salary", 10, 2)->nullable();
            $table->string("workplace", 200)->nullable();
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
        Schema::dropIfExists('job_opportunities');
    }
}
