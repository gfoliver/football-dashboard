<?php 

namespace App\Core\Services;

use App\Core\Entities\Season;
use App\Core\Repositories\Contracts\ISeasonsRepository;
use App\Core\Services\Contracts\ISeasonsService;
use Illuminate\Database\Eloquent\Collection;

class SeasonsService implements ISeasonsService {
    private ISeasonsRepository $repository;

    public function __construct(ISeasonsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $data): ?Season
    {
        return $this->repository->save($data);
    }

    public function delete(int $id): Bool
    {
        return $this->repository->delete($id);
    }

    public function byId(int $id): ?Season
    {
        return $this->repository->byId($id);
    }

    public function byLeague(int $leagueId): Collection
    {
        return $this->repository->byLeague($leagueId);
    }

    public function currentSeasonByLeague(int $leagueId): ?Season
    {
        return $this->repository->currentSeasonByLeague($leagueId);
    }
}