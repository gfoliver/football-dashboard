<?php 

namespace App\Core\Services\Contracts;

use App\Core\Entities\Match;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IMatchesService {
    public function save(array $data): ?Match;
    
    public function delete(int $id): Bool;

    public function list(): ?Collection;
    
    public function paginate(int $per_page = 10): ?LengthAwarePaginator;
    
    public function bySeason(int $seasonId): ?Collection;
}