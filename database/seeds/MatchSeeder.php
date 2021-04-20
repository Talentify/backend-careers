<?php

use Illuminate\Database\Seeder;
use App\Models\Match;
use App\Models\Goal;
use App\Models\Card;
use App\Models\Team;
use App\Enums\MatchScoreEnum;
use Illuminate\Support\Arr;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Match::class, 30)->create()->each(function($match) {

            $home_team_goals = 0;
            $visitor_team_goals = 0;

            if ($match->home_team_score === MatchScoreEnum::WIN) {
                $home_team_goals = Arr::random(range(1, 10));
                $visitor_team_goals = Arr::random(range(1, $home_team_goals - 1));
            } elseif ($match->home_team_score === MatchScoreEnum::LOSE) {
                $visitor_team_goals = Arr::random(range(1, 10));
                $home_team_goals = Arr::random(range(1, $visitor_team_goals - 1));
            } else {
                $home_team_goals = Arr::random(range(1, 10));
                $visitor_team_goals = $home_team_goals;
            }

//            $home_team_players_ids = Team::find($match->home_team_id)->players()->pluck('id')->toArray();
//            $visitor_team_players_ids = Team::find($match->visitor_team_id)->players()->pluck('id')->toArray();

            for($i = 1; $i === $home_team_goals; $i++) {
                $match->goals()->save(
                    factory(Goal::class)->make([
                        'team_id' => $match->home_team_id,
                        'player_id' => $match->home_team_id * Arr::random(range(1, 5))
                    ])
                );
            }

            for($i = 1; $i === $visitor_team_goals; $i++) {
                $match->goals()->save(
                    factory(Goal::class)->make([
                        'team_id' => $match->visitor_team_id,
                        'player_id' => $match->visitor_team_id * Arr::random(range(1, 5))
                    ])
                );
            }

            $home_team_cards = Arr::random(range(0, 5));
            $visitor_team_cards = Arr::random(range(0, 5));

            if ($home_team_cards > 0) {
                for($i = 1; $i === $home_team_cards; $i++) {
                    $match->cards()->save(
                        factory(Card::class)->make([
                            'team_id' => $match->home_team_id,
                            'player_id' => $match->home_team_id * Arr::random(range(1, 5))
                        ])
                    );
                    
                }
            }

            if ($visitor_team_cards > 0) {
                for($i = 1; $i === $visitor_team_cards; $i++) {
                    $match->cards()->save(
                        factory(Card::class)->make([
                            'team_id' => $match->visitor_team_id,
                            'player_id' => $match->visitor_team_id * Arr::random(range(1, 5))
                        ])
                    );
                }
            }

        });
    }
}
