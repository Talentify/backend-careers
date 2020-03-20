<?php

use App\Models\V1\User;
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
        User::create([
            'name'              => 'Teste Talentify',
            'email'             => 'teste@talentify.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('talentify'),
        ]);
    }
}
