<?php

namespace Database\Seeders;

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
        \App\Core\Entities\Team::create(['name' => 'Manchester United']);
        \App\Core\Entities\Team::create(['name' => 'Chelsea']);

        \App\Core\Entities\League::create(['name' => 'Premier League', 'slug' => 'premier-league']);

        \App\Core\Entities\Season::create([
            'name'          => 'Premier League - 20/21', 
            'starts_in'     => 2020, 
            'ends_in'       => 2021, 
            'league_id'     => 1,
            'active'        => true
        ]);

        \App\Core\Entities\SeasonStanding::create([
            'season_id'         => 1,
            'team_id'           => 1,
            'points'            => 7,
            'matches'           => 3,
            'wins'              => 2,
            'draws'             => 1,
            'losses'            => 0,
            'goals_scored'      => 8,
            'goals_conceded'    => 3,
            'goal_difference'   => 5,
        ]);

        \App\Core\Entities\SeasonStanding::create([
            'season_id'         => 1,
            'team_id'           => 2,
            'points'            => 1,
            'matches'           => 3,
            'wins'              => 0,
            'draws'             => 1,
            'losses'            => 2,
            'goals_scored'      => 3,
            'goals_conceded'    => 8,
            'goal_difference'   => -5,
        ]);
    }
}
