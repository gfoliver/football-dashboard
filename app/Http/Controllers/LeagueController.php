<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\ILeaguesService;
use App\Core\Services\Contracts\ISeasonsService;
use App\Core\Services\Contracts\ISeasonStandingsService;

class LeagueController extends Controller
{
    private ILeaguesService $service;
    private ISeasonsService $seasonsService;
    private ISeasonStandingsService $standingsService;

    public function __construct(
        ILeaguesService $service, 
        ISeasonsService $seasonsService, 
        ISeasonStandingsService $standingsService
    )
    {
        $this->service = $service;
        $this->seasonsService = $seasonsService;
        $this->standingsService = $standingsService;
    }

    public function index()
    {
        $leagues = $this->service->list();

        return view('pages.leagues.list', compact('leagues'));
    }

    public function inner(int $id)
    {
        $standings = null;
        
        $league = $this->service->byId($id);
        $season = $this->seasonsService->currentSeasonByLeague($id);

        if (isset($season))
            $standings = $this->standingsService->bySeason($season->id);

        return view('pages.leagues.inner', compact(['league', 'season','standings']));
    }

    public function delete(int $id)
    {
        $deleted = $this->service->delete($id);

        return response([
            'status'    => $deleted
        ], $deleted ? 200 : 400);
    }
}
