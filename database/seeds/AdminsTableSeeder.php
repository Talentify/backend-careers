<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(
            [
                'name'          => 'admin',
                'email'         => 'admin@workking.com',
                'api_token'     => 'API_TOKEN',
                'expires_token' => Carbon::now()->addHours(10),
                'password'      => Hash::make('Workking@admin')
            ]
        );
    }
}
