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
            $table->bigIncrements('id');
            $table->string('title', 256)->nullable(false);
            $table->string('description', 1000)->nullable(false);
            $table->enum('status', ['opened', 'closed'])->nullable(false);
            $table->string('workplace', 1000)->nullable();
            $table->double('salary', 8,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    // Interface administrativa, de acesso privado, com os seguintes recursos:
    // Cadastro de vaga contendo os campos: 
    // title (string, 256 characteres, obrigatório) , 
    // description (string, 10000 caracteres, obrigatório), 
    // status (enum, obrigatório), 
    // workplace (endereço, opcional), 
    // salary (dólar americano, opicional).
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
