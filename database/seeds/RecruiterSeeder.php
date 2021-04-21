<?php

use Illuminate\Database\Seeder;
use App\Models\Recruiter;

class RecruiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recruiter::class, 10)->create();
    }
}
