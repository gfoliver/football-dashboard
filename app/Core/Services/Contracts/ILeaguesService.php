<?php

namespace App\Core\Services\Contracts;

use \App\Core\Entities\League;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ILeaguesService {
    public function save(array $data): ?League;

    public function list(): ?Collection;

    public function paginate(int $per_page = 10): LengthAwarePaginator;

    public function delete(int $id): Bool;

    public function byId(int $id): ?League;

    public function bySlug(string $slug): ?League;
}
