<?php

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
        $arrUsers = [
            [
                'name' => 'Client User',
                'email' => "client-test@talentify.com",
                'type' => 'client',
                'password' => '$2y$10$j702KbD5lVHNOmxsEflohej9j8VsHCW01g53BRYKycsGrkgz0xknO' //secret123
            ],
            [
                'name' => 'Admin',
                'email' => "admin-test@talentify.com",
                'type' => 'admin',
                'password' => '$2y$10$j702KbD5lVHNOmxsEflohej9j8VsHCW01g53BRYKycsGrkgz0xknO' //secret123
            ],
        ];

        foreach ($arrUsers as $arrayToInsert => $array) {
            DB::table('users')->insert($array);
        }
    }
}
