<?php 

namespace App\Core\Services;

use App\Core\Entities\SeasonStanding;
use App\Core\Repositories\Contracts\ISeasonStandingsRepository;
use App\Core\Services\Contracts\ISeasonStandingsService;
use Illuminate\Database\Eloquent\Collection;

class SeasonStandingsService implements ISeasonStandingsService {
    private ISeasonStandingsRepository $repository;

    public function __construct(ISeasonStandingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $data): ?SeasonStanding
    {
        return $this->repository->save($data);
    }

    public function delete(int $id): Bool
    {
        return $this->repository->delete($id);
    }

    public function byId(int $id): ?SeasonStanding
    {
        return $this->repository->byId($id);
    }

    public function bySeason(int $seasonId): Collection
    {
        return $this->repository->bySeason($seasonId);
    }

    public function saveMany(int $seasonId, array $teamIds): Bool
    {
        $data = array_map(function($teamId) use ($seasonId) {
            return [
                'team_id'           => $teamId,
                'season_id'         => $seasonId,
                'points'            => 0,
                'matches'           => 0,
                'wins'              => 0,
                'draws'             => 0,
                'losses'            => 0,
                'goal_difference'   => 0,
                'goals_scored'      => 0,
                'goals_conceded'    => 0,
            ];
        }, $teamIds);

        return $this->repository->saveMany($data);
    }
}