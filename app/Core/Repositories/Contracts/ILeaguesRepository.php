<?php

namespace App\Core\Repositories\Contracts;

use \App\Core\Entities\League;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ILeaguesRepository {
    public function save(array $data): ?League;

    public function list(): ?Collection;

    public function paginate(int $per_page): LengthAwarePaginator;

    public function delete(int $id): Bool;

    public function byId(int $id): ?League;

    public function bySlug(string $slug): ?League;
}
