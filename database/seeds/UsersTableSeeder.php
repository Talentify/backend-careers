<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users[] = [
            'uuid' => Str::uuid()->toString(),
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'user_admin' => 1
        ];
        $users[] = [
            'uuid' => Str::uuid()->toString(),
            'name' => 'Users',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'user_admin' => 0
        ];

        DB::table('users')->insert($users);
    }
}
