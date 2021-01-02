<?php

namespace App\Core\Services;

use App\Core\Services\Contracts\ITeamsService;
use App\Core\Repositories\Contracts\ITeamsRepository;
use \App\Core\Entities\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamsService implements ITeamsService {
    private ITeamsRepository $repository;

    public function __construct(ITeamsRepository $repository) 
    {
        $this->repository = $repository;
    }

    public function save(array $data): ?Team 
    {
        if (isset($data['logo'])) {
            if (isset($data['id'])) {
                $team = $this->repository->byId($data['id']);

                if (isset($team) && isset($team->logo)) {
                    Storage::disk('teams')->delete($team->getRawOriginal('logo'));
                }
            }

            $path = $data['logo']->store('/', 'teams');

            $data['logo'] = $path;
        }

        return $this->repository->save($data);
    }

    public function list(): ?Collection
    {
        return $this->repository->list();
    }

    public function paginate(int $per_page = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($per_page);
    }

    public function delete(int $id): Bool
    {
        if ($team = $this->repository->byId($id)) {
            
            $logo = $team->getRawOriginal('logo');

            if (isset($logo)) {
                Storage::disk('teams')->delete($logo);
            }

            return $this->repository->delete($id);
        }

        return false;
    }

    public function byId(int $id): ?Team
    {
        return $this->repository->byId($id);
    }
}
