<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios1 = Permission::firstOrCreate([
            'name' => 'job-view',
            'description' => 'job-view',
        ]);
        $usuarios2 = Permission::firstOrCreate([
            'name' => 'job-create',
            'description' => 'job-create',
        ]);
        $usuarios3 = Permission::firstOrCreate([
            'name' => 'job-update',
            'description' => 'job-update',
        ]);
        $usuarios4 = Permission::firstOrCreate([
            'name' => 'job-destroy',
            'description' => 'job-destroy',
        ]);
    }
}
