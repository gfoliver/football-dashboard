<?php 

namespace App\Core\Services;

use App\Core\Entities\SeasonStanding;
use App\Core\Repositories\Contracts\ISeasonStandingsRepository;
use App\Core\Services\Contracts\ISeasonStandingsService;
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
}