<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class AddAdminOnUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $timestamp = Carbon::now();
        $userData = [
            'email' => 'support@talentify.com',
            'name' => 'Support Talentify',
            'password' => '$2y$10$8FzMQe0nVITFAHDPpyXIdOMWrg30qhKc.E6exGPnKBQWdULcIUaxi',
            'remember_token' => Str::random(10),
            'email_verified_at' => $timestamp,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ];

        $userData['id'] = DB::table('users')->insertGetId($userData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->truncate();
    }
}
