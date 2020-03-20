<?php

use App\Models\V1\Position;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 256);
            $table->string('description', 1000);
            $table->enum('status', [
                Position::CREATED,
                Position::INTERVIEWING,
                Position::CONCLUDED,
                Position::CANCELLED,
            ]);
            $table->string('workplace', 256)->nullable();
            $table->float('salary')->nullable();

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
        Schema::dropIfExists('positions');
    }
}
