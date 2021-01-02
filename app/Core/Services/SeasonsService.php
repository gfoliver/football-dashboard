<?php 

namespace App\Core\Services;

use App\Core\Entities\Season;
use App\Core\Repositories\Contracts\ISeasonsRepository;
use App\Core\Services\Contracts\ILeaguesService;
use App\Core\Services\Contracts\ISeasonsService;
use App\Core\Services\Contracts\ISeasonStandingsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class SeasonsService implements ISeasonsService {
    private ISeasonsRepository $repository;
    private ILeaguesService $leaguesService;
    private ISeasonStandingsService $standingsService;

    public function __construct(
        ISeasonsRepository $repository, 
        ILeaguesService $leaguesService, 
        ISeasonStandingsService $standingsService
    )
    {
        $this->repository = $repository;
        $this->leaguesService = $leaguesService;
        $this->standingsService = $standingsService;
    }

    public function save(array $data): ?Season
    {
        $leagueName = $this->leaguesService->byId($data['league_id'])->name;
        $data['name'] = sprintf('%s - %s/%s', $leagueName, substr($data['starts_in'], 2), substr($data['ends_in'], 2));

        $teams = $data['teams'];

        unset($data['teams']);    

        $season = $this->repository->save($data);

        $this->standingsService->saveMany($season->id, $teams);

        return $season;
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

    public function teams(int $id): ?SupportCollection
    {
        return $this->repository->teams($id);
    }
}