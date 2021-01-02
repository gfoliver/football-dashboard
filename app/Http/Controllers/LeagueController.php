<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\ILeaguesService;
use App\Core\Services\Contracts\ISeasonsService;
use App\Core\Services\Contracts\ISeasonStandingsService;
use App\Http\Requests\SaveLeague;
use Exception;

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

    public function inner(string $slug)
    {
        $standings = null;
        
        $league = $this->service->bySlug($slug);

        if (! isset($league))
            abort(404);

        $season = $this->seasonsService->currentSeasonByLeague($league->id);

        if (isset($season))
            $standings = $this->standingsService->bySeason($season->id);

        return view('pages.leagues.inner', compact(['league', 'season','standings']));
    }

    public function form(int $id = null)
    {
        $league = null;

        if (isset($id)) {
            $league = $this->service->byId($id);
        
            if (! isset($league))
                abort(404);
        }

        return view('pages.leagues.form', compact(['league', 'id']));
    }

    public function save(SaveLeague $data)
    {
        try {
            $league = $this->service->save($data->all());

            return response([
                'status'    => true,
                'data'      => $league
            ]);
        } 
        catch (Exception $e) {
            return response([
                'status'    => false,
                'error'     => $e      
            ], 400);
        }
    }

    public function delete(int $id)
    {
        $deleted = $this->service->delete($id);

        return response([
            'status'    => $deleted
        ], $deleted ? 200 : 400);
    }
}
