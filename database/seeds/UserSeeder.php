<?php

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user = User::updateOrCreate(['id' => 1], [
            'name' => 'Administrator',
            'lastname' => 'System',
            'email' => 'admin@admin.com',
            'password' => 'admin@123',
            'role_id' => 1
        ]);
    }
}
