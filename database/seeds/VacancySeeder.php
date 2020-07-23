<?php


use Phinx\Seed\AbstractSeed;

class VacancySeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'title'  => $faker->title,
                'description' => $faker->text,
                'workplace' => $faker->jobTitle,
                'salary' => $faker->randomFloat(),
                'status' => rand(0, 1),
            ];
        }

        $this->table('vacancies')->insert($data)->saveData();
    }
}
