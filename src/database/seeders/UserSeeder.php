<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->fill(
            [
                    'name' => 'Talentify',
                    'username' => 'talentify',
                    'password' => Hash::make('talentify')
                ]
        );
        $user->save();
    }

}
