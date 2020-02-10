<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, "code" => "admin", "name" => "Administrator"],
            ['id' => 2, "code" => "user", "name" => "User"]
        ];

        foreach ($data as $item) {
            Role::withTrashed()->updateOrCreate(['id' => $item['id']], $item);
        }//
    }
}
