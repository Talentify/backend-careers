<?php

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = Position::all()->count();
        if($positions == 0) {
            Position::create(
                [
                    "title" => "Senior Dev Laravel",
                    "description" => "Atuar no Desenvolvimento de Backend.",
                    "address" => "Remoto",
                    "salary" => "13000",
                    "status" => 1,
                    "company_id" => 1,
                    "recruiter_id" => 1
                ]);

            Position::create(
                [
                    "title" => "Senior Dev Vue JS",
                    "description" => "Atuar no Desenvolvimento de Frontend.",
                    "address" => "Remoto",
                    "salary" => "13000",
                    "status" => 0,
                    "company_id" => 1,
                    "recruiter_id" => 1
                ]);
        }
    }
}
