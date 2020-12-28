<?php

namespace App\Core\Repositories\Contracts;

use App\Core\Entities\SeasonStanding;
use Illuminate\Database\Eloquent\Collection;

interface ISeasonStandingsRepository {
    public function save(array $data): ?SeasonStanding;

    public function delete(int $id): Bool;

    public function byId(int $id): ?SeasonStanding;

    public function bySeason(int $seasonId): Collection;
}
