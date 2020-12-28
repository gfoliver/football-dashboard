<?php 

namespace App\Core\Services;

use App\Core\Entities\League;
use App\Core\Repositories\Contracts\ILeaguesRepository;
use App\Core\Services\Contracts\ILeaguesService;
use Illuminate\Database\Eloquent\Collection;

class LeaguesService implements ILeaguesService {
    private ILeaguesRepository $repository;

    public function __construct(ILeaguesRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function save(array $data): ?League
    {
        return $this->repository->save($data);
    }

    public function delete(int $id): Bool
    {
        return $this->repository->delete($id);
    }

    public function byId(int $id): ?League
    {
        return $this->repository->byId($id);
    }

    public function list(): Collection
    {
        return $this->repository->list();
    }
}