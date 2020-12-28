<?php 

namespace App\Core\Repositories;

use App\Core\Entities\League;
use App\Core\Repositories\Contracts\ILeaguesRepository;
use Illuminate\Database\Eloquent\Collection;

class LeaguesRepository implements ILeaguesRepository {
    public function save(array $data): ?League
    {
        if (isset($data['id'])) {
            $league = League::find($data['id']);

            $league->fill($data);
            $league->save();

            return $league;
        }

        $league = League::create($data);
        
        return $league;
    }

    public function byId(int $id): ?League
    {
        return League::find($id);
    }

    public function delete(int $id): Bool
    {
        return $this->byId($id)->delete();
    }

    public function list(): Collection
    {
        return League::all();
    }
}
