<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'adresses',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('street')->nullable(true);
                $table->string('city')->nullable(true);
                $table->string('state')->nullable(true);
                $table->string('state_full')->nullable(true);
                $table->string('zip_code')->nullable(true);
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
        Schema::dropIfExists('adresses');
    }
}
