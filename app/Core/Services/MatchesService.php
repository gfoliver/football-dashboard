<?php 

namespace App\Core\Services;

use App\Core\Constants\Side;
use App\Core\Entities\Match;
use App\Core\Repositories\Contracts\IMatchesRepository;
use App\Core\Services\Contracts\IMatchesService;
use App\Core\Services\Contracts\ISeasonStandingsService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MatchesService implements IMatchesService {
    protected IMatchesRepository $repository;
    protected ISeasonStandingsService $standingsService;

    public function __construct(IMatchesRepository $repository, ISeasonStandingsService $standingsService) {
        $this->repository = $repository;
        $this->standingsService = $standingsService;
    }

    public function save(array $data): ?Match
    {
        $match = $this->repository->save($data);
     
        $this->standingsService->updateWithMatch($match->home_team_id, $match, Side::Home);
        $this->standingsService->updateWithMatch($match->away_team_id, $match, Side::Away);

        return $match;
    }

    public function delete(int $id): Bool
    {
        // Remover partidas jogadas, gols e pontos dos times

        return $this->repository->delete($id);
    }

    public function list(): ?Collection
    {
        return $this->repository->list();
    }

    public function paginate(int $per_page = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($per_page);
    }

    public function bySeason(int $seasonId): ?Collection
    {
        return $this->repository->bySeason($seasonId);
    }
}