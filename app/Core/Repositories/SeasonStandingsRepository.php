<?php 

namespace App\Core\Repositories;

use App\Core\Entities\SeasonStanding;
use \App\Core\Repositories\Contracts\ISeasonStandingsRepository;
use Illuminate\Database\Eloquent\Collection;

class SeasonStandingsRepository implements ISeasonStandingsRepository {
    public function save(array $data): ?SeasonStanding 
    {
        if (isset($data['id'])) {
            $seasonStanding = SeasonStanding::find($data['id']);

            $seasonStanding->fill($data);
            $seasonStanding->save();

            return $seasonStanding;
        }

        $seasonStanding = SeasonStanding::create($data);
        
        return $seasonStanding;
    }

    public function byId(int $id): ?SeasonStanding
    {
        return SeasonStanding::find($id);
    }

    public function delete(int $id): Bool
    {
        return $this->byId($id)->delete();
    }

    public function bySeason(int $seasonId): Collection
    {
        return SeasonStanding::where('season_id', $seasonId)->orderBy('points', 'DESC')->get();
    }
}