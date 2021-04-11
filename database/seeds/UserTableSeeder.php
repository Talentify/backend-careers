<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Josiane Silveira',
                'username' => 'jsilveira',
                'email' => 'jsilveira',
                'password' => bcrypt('123456'),
                'company_id' => 1
            ],
            [
                'name' => 'Paulo Mariano',
                'username' => 'pmariano',
                'email' => 'pmariano@gmail.com',
                'password' => bcrypt('123456'),
                'company_id' => 2
            ],
        ]);
    }
}
