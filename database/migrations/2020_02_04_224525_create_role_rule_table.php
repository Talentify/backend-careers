<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id')->nullable(false)->default(0);
            $table->unsignedBigInteger('rule_id')->nullable(false)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['role_id', 'rule_id']);

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('rule_id')->references('id')->on('rules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_rule');
    }
}
