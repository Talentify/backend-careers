<?php

use Illuminate\Database\Seeder;

use App\Models\Rule;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, "code" => "jobs.list", "name" => "Jobs List"],
            ['id' => 2, "code" => "job.view", "name" => "Job View"],
            ['id' => 3, "code" => "job.insert", "name" => "Job Insert"],
            ['id' => 4, "code" => "job.update", "name" => "Job Update"],
            ['id' => 5, "code" => "job.delete", "name" => "Job Delete"],

            ['id' => 6, "code" => "users.list", "name" => "Users List"],
            ['id' => 7, "code" => "user.view", "name" => "User View"],
            ['id' => 8, "code" => "user.insert", "name" => "User Insert"],
            ['id' => 9, "code" => "user.update", "name" => "User Update"],
            ['id' => 10, "code" => "user.delete", "name" => "User Delete"],
            
        ];

        foreach ($data as $item) {
            Rule::withTrashed()->updateOrCreate(['id' => $item['id']], $item);
        }//
    }
}
