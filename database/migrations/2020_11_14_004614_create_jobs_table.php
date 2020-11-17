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
        Schema::create(
            'jobs',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('address_id')
                    ->nullable(true);
                $table->uuid('user_id')
                    ->nullable(true);
                $table->string('title', 256)
                    ->nullable(false);
                $table->string('slug')
                    ->nullable(false);
                $table->longText('description')
                    ->nullable(true);
                $table->enum('status', [1, 2, 3])
                    ->nullable(false)
                    ->default(1)
                    ->comment('1 - Open, 2 - Closed, 3 - Inactive');
                $table->decimal('salary')
                    ->nullable(true);

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
                $table->foreign('address_id')
                    ->references('id')
                    ->on('adresses');
                $table->timestampsTz();
                $table->softDeletesTz();
            }
        );
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
