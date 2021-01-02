<?php 

namespace App\Core\Repositories;

use App\Core\Entities\Match;
use App\Core\Repositories\Contracts\IMatchesRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MatchesRepository implements IMatchesRepository {
    public function save(array $data): ?Match
    {
        if (isset($data['id'])) {
            $match = Match::find($data['id']);

            $match->fill($data);
            $match->save();

            return $match;
        }

        $match = Match::create($data);
        
        return $match;
    }

    public function delete(int $id): Bool
    {
        return Match::find($id)->delete();
    }

    public function list(): ?Collection
    {
        return Match::all();
    }

    public function paginate(int $per_page): LengthAwarePaginator
    {
        return Match::paginate($per_page);
    }

    public function bySeason(int $seasonId): ?Collection
    {
        return Match::where('season_id', $seasonId)->get();
    }
}