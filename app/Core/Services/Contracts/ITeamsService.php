<?php 

namespace App\Core\Services\Contracts;

use \App\Core\Entities\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ITeamsService {
    public function save(array $data): ?Team;

    public function list(): ?Collection;

    public function paginate(int $per_page = 10): LengthAwarePaginator;

    public function delete(int $id): Bool;

    public function byId(int $id): ?Team;
}
