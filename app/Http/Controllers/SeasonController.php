<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\ILeaguesService;
use App\Core\Services\Contracts\ISeasonsService;
use App\Core\Services\Contracts\ISeasonStandingsService;
use App\Core\Services\Contracts\ITeamsService;
use App\Http\Requests\SaveSeason;
use Exception;

class SeasonController extends Controller
{
    private ILeaguesService $leaguesService;
    private ISeasonsService $service;
    private ISeasonStandingsService $standingsService;
    private ITeamsService $teamsService;

    public function __construct(
        ISeasonsService $service, 
        ILeaguesService $leaguesService, 
        ISeasonStandingsService $standingsService,
        ITeamsService $teamsService
    )
    {
        $this->service = $service;
        $this->leaguesService = $leaguesService;
        $this->standingsService = $standingsService;
        $this->teamsService = $teamsService;
    }

    public function index(string $slug)
    {
        $league = $this->leaguesService->bySlug($slug);

        if (!isset($league))
            abort(404);

        $seasons = $this->service->byLeague($league->id);

        return view('pages.leagues.seasons', compact(['seasons', 'league']));
    }

    public function inner(string $slug, int $id)
    {
        $league = $this->leaguesService->bySlug($slug);

        $season = $this->service->byId($id);

        if (!isset($league) || ! isset($season))
            abort(404);

        if ($season->league_id != $league->id)
            abort(404);

        $standings = $season->seasonStandings;

        return view('pages.leagues.seasons-inner', compact(['season', 'league', 'standings']));
    }

    public function form(string $slug, int $id = null)
    {
        $season = null;

        $league = $this->leaguesService->bySlug($slug);
        $league_id = $league->id;

        if (isset($id)) {
            $season = $this->service->byId($id);

            if (!isset($season))
                abort(404);
        }

        $leagues = $this->leaguesService->list();

        $teams = $this->teamsService->list();

        return view('pages.leagues.seasons-form', compact(['season', 'leagues', 'id', 'league','league_id', 'teams']));
    }

    public function save(SaveSeason $data)
    {
        try {
            $season = $this->service->save($data->all());

            return response([
                'status'    => true,
                'data'      => $season
            ]);
        }
        catch(Exception $e) {
            dd($e);

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
