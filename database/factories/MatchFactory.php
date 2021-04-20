<?php

use App\Models\Match;
use Faker\Generator as Faker;

$factory->define(Match::class, function (Faker $faker) {
    $home_team_id = $faker->numberBetween(1, 10);
    $visitor_team_id =  null;

    do {
        $visitor_team_id = $faker->numberBetween(1, 10);
    } while($home_team_id === $visitor_team_id);

    $home_team_score = $faker->randomElement(['W', 'L', 'T']);
    $visitor_team_score = null;
    if ($home_team_score === 'W') $visitor_team_score = 'L';
    if ($home_team_score === 'L') $visitor_team_score = 'W';
    if ($home_team_score === 'T') $visitor_team_score = 'T';

    return [
        'date' => now()->format('Y-m-d'),
        'start_time' => now()->format('H:i:s'),
        'end_time' => now()->addMinutes(90)->format('H:i:s'),
        'home_team_id' => $home_team_id,
        'visitor_team_id' => $visitor_team_id,
        'home_team_score' => $home_team_score,
        'visitor_team_score' => $visitor_team_score
    ];
});
