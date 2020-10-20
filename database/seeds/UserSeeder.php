<?php

use App\User;
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
        User::create([
            'name'     => 'Usuário de teste',
            'email'    => 'usuarii@teste.com',
            'password' => bcrypt('abc123.')
        ]);
    }
}
