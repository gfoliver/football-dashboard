<?php

namespace App\Core\Services\Contracts;

use \App\Core\Entities\League;
use Illuminate\Database\Eloquent\Collection;

interface ILeaguesService {
    public function save(array $data): ?League;

    public function list(): ?Collection;

    public function delete(int $id): Bool;

    public function byId(int $id): ?League;

    public function bySlug(string $slug): ?League;
}
