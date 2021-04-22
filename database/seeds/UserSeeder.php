<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make('admin')
       ]);

       User::create([
           'name' => 'user',
           'email' => 'user@user.com',
           'password' => Hash::make('user')
       ]);

        User::create([
            'name' => 'pedro',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('pedro')
        ]);

        User::create([
            'name' => 'josé',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('jose')
        ]);

        User::create([
            'name' => 'marcos',
            'email' => 'marcos@outlook.com',
            'password' => Hash::make('marcos')
        ]);
    }
}
