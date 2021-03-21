<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            "name"      => "Administrator",
            "email"     => "admin@admin.com.br",
            "password"  => bcrypt("12345678"),
        ];

        \App\User::create($user);
    }
}
