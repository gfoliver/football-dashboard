<?php

namespace App\Core\Services;

use App\Core\Services\Contracts\ITeamsService;
use App\Core\Repositories\Contracts\ITeamsRepository;
use \App\Core\Entities\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamsService implements ITeamsService {
    private ITeamsRepository $repository;

    public function __construct(ITeamsRepository $repository) 
    {
        $this->repository = $repository;
    }

    public function save(array $data): ?Team 
    {
        return $this->repository->save($data);
    }

    public function list(): ?Collection
    {
        return $this->repository->list();
    }

    public function delete(int $id): Bool
    {
        return $this->repository->delete($id);
    }

    public function byId(int $id): ?Team
    {
        return $this->repository->byId($id);
    }
}
