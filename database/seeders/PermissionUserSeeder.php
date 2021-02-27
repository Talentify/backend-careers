<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::firstOrCreate(
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => '123456'
            ]
        );
        $user2 = User::firstOrCreate(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '123456'
            ]
        );
        $role = Role::where('name', 'Admin')->first();
        $user2->roles()->attach($role);

        $permissions = Permission::whereIn('name', ['job-view', 'job-create', 'job-update', 'job-destroy'])->get();

        $role->permissions()->attach($permissions);
    }
}
