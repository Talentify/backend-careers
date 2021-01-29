<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Tiago Perrelli',
                'email' => 'tiago@gmail.com',
                'password' =>  bcrypt(123456)
            ]    
        ];

        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
