<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(RuleSeeder::class);
        $this->call(RoleRuleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
