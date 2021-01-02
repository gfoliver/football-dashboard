<?php

namespace App\Core\Services\Contracts;

use \App\Core\Entities\Season;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface ISeasonsService {
    public function save(array $data): ?Season;

    public function delete(int $id): Bool;

    public function byId(int $id): ?Season;

    public function byLeague(int $leagueId): ?Collection;

    public function currentSeasonByLeague(int $leagueId): ?Season;

    public function teams(int $id): ?SupportCollection;
}
