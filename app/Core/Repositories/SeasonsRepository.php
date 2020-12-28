<?php 

namespace App\Core\Repositories;

use App\Core\Entities\Season;
use App\Core\Repositories\Contracts\ISeasonsRepository;
use Illuminate\Database\Eloquent\Collection;

class SeasonsRepository implements ISeasonsRepository {
    public function save(array $data): ?Season
    {
        if (isset($data['id'])) {
            $season = Season::find($data['id']);

            $season->fill($data);
            $season->save();

            return $season;
        }

        $season = Season::create($data);
        
        return $season;
    }

    public function byId(int $id): ?Season
    {
        return Season::find($id);
    }

    public function byLeague(int $leagueId): Collection
    {
        return Season::where('league_id', $leagueId)->get();
    }

    public function delete(int $id): Bool
    {
        return $this->byId($id)->delete();
    }

    public function currentSeasonByLeague(int $leagueId): ?Season
    {
        return Season::where('league_id', $leagueId)->where('active', 1)->first();
    }
}
