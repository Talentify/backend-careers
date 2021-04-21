<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use App\Enums\JobStatus;
use App\Models\Job;

$factory->define(Job::class, function (Faker $faker) {
    $titleType = Arr::random(['Home-office', 'Presencial', 'Parcial']);
    $titleExp = Arr::random(['Júnior', 'Pleno', 'Sênior']);
    $titleTechs = Arr::random(['PHP', 'Node', 'Python', 'Java', '.NET', 'Golang', 'Ruby', 'React', 'Vue',
        'Angular']);
    $company = $faker->company;

    return [
        'title' => "Vaga $titleType para Desenvolvedor $titleTechs $titleExp - $company",
        'description' => addslashes($faker->realText(500)),
        'status' => Arr::random([JobStatus::OPEN, JobStatus::PROGRESS, JobStatus::CLOSE]),
        'address' => $faker->address,
        'salary' => $faker->randomFloat(2, $min = 1280, 15748),
        'company' => $company,
        'recruiter_id' => Arr::random(range(1, 10))
    ];
});
