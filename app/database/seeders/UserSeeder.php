<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
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
        User::factory()->create(
            [
                'email'     =>  'admin.active@example.net',
                'password'  =>  'admin@1234556',
                'role'      =>  RolesEnum::ADMIN_ROLE,
                'status'    =>  'active'
            ]
        );

        User::factory()->create(
            [
                'email'     =>  'admin.inactive@example.net',
                'password'  =>  'admin@654321',
                'role'      =>  RolesEnum::ADMIN_ROLE,
                'status'    =>  'inactive'
            ]
        );

        User::factory()->create(
            [
                'email'     =>  'company@example.net',
                'password'  =>  'company@1234556',
                'role'      =>  RolesEnum::COMPANY_ROLE,
                'status'    =>  'active'
            ]
        );
    }
}
