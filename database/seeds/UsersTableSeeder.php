<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'neves',
            'email'=> 'nevesiago8@hotmail.com',
            'password'=> bcrypt('12345'),
        ]);
    }
}
