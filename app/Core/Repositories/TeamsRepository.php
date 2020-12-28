<?php 

namespace App\Core\Repositories;

use \App\Core\Repositories\Contracts\ITeamsRepository;
use \App\Core\Entities\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamsRepository implements ITeamsRepository {
    public function save(array $data): ?Team 
    {
        if (isset($data['id'])) {
            $team = Team::find($data['id']);

            $team->fill($data);
            $team->save();

            return $team;
        }

        $team = Team::create($data);
        
        return $team;
    }

    public function list(): ?Collection
    {
        return Team::all();
    }

    public function byId(int $id): ?Team
    {
        return Team::find($id);
    }

    public function delete(int $id): Bool
    {
        return $this->byId($id)->delete();
    }
}
