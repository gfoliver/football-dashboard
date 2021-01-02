<?php

namespace App\Core\Services\Contracts;

use App\Core\Entities\Match;
use App\Core\Entities\SeasonStanding;
use Illuminate\Database\Eloquent\Collection;

interface ISeasonStandingsService {
    public function save(array $data): ?SeasonStanding;

    public function saveMany(int $seasonId, array $teamIds): Bool;

    public function delete(int $id): Bool;

    public function byId(int $id): ?SeasonStanding;

    public function bySeason(int $seasonId): Collection;

    public function updateWithMatch(int $id, Match $match, string $side): ?SeasonStanding;
}
