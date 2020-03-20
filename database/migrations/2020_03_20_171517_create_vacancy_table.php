<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vacancy', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title', 256);
			$table->string('description', 10000);
			$table->string('status');
			$table->string('workplace')->nullable();
			$table->string('salary')->nullable();
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
		Schema::dropIfExists('vacancy');
	}

}
