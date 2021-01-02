<?php 

namespace App\Core\Services;

use App\Core\Constants\Side;
use App\Core\Entities\Match;
use App\Core\Entities\SeasonStanding;
use App\Core\Repositories\Contracts\ISeasonStandingsRepository;
use App\Core\Services\Contracts\ISeasonStandingsService;
use Exception;
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

    public function updateWithMatch(int $id, Match $match, string $side): ?SeasonStanding
    {
        if ($standing = $this->repository->byId($id)) {
            if (! ($side == Side::Home || $side == Side::Away)) {
                throw new Exception('Parameter $side must be an instance of App\Core\Constants\Side');
            }

            $otherSide = Side::otherSide($side);

            $goalsScored = $standing->goals_scored + $match->{$side . '_team_goals'};
            $goalsConceded = $standing->goals_conceded + $match->{$otherSide . '_team_goals'};
            $won = (! is_null($match->winner_id)) && $match->winner_id == $standing->team_id;
            $draw = is_null($match->winner_id);
            $lost = (! is_null($match->winner_id)) && $match->winner_id != $standing->team_id;

            $standing->fill([
                'matches'           => $standing->matches + 1,
                'points'            => $standing->points + $this->calcPointsByResult($standing->team_id, $match),
                'goals_scored'      => $goalsScored,
                'goals_conceded'    => $goalsConceded,
                'goal_difference'   => $goalsScored - $goalsConceded,
                'wins'              => $standing->wins + (int)$won,
                'draws'             => $standing->draws + (int)$draw,
                'losses'            => $standing->losses + (int)$lost
            ]);

            $saved = $this->repository->save($standing->toArray());

            return $saved;
        }

        return null;
    }

    protected function calcPointsByResult(int $teamId, Match $match): int
    {
        if ($match->winner_id) {
            if ($match->winner_id == $teamId)
                return 3;
            else
                return 0;
        }

        return 1;
    }
}