<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pape1 = Role::firstOrCreate(
            [
                'name' => 'Admin',
                'description' => 'Admin',
            ]
        );

        $pape2 = Role::firstOrCreate(
            [
                'name' => 'User',
                'description' => 'User',
            ]
        );
    }
}
