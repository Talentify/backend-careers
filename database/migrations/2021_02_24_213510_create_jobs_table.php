<?php

use App\Models\Enums\StatusEnum;
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
            $table->string('title', 256)->nullable(false);
            $table->string('description', 1000)->nullable(false);
            $table->foreignId('creator_id')->nullable(false);
            $table->enum('status', [
                StatusEnum::OPEN(),
                StatusEnum::STANDBY(),
                StatusEnum::FINISHED(),
                StatusEnum::CLOSED(),
            ])->nullable(false);
            $table->string('workplace', 256)->nullable();
            $table->decimal('salary', 9,2)->nullable();
            $table->timestamps();


            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
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
