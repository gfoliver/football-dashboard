<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\ILeaguesService;
use App\Core\Services\Contracts\ITeamsService;

class ContentController extends Controller
{
    protected ILeaguesService $leaguesService;
    protected ITeamsService $teamsService;

    public function __construct(
        ILeaguesService $leaguesService,
        ITeamsService $teamsService
    ) {
        $this->leaguesService = $leaguesService;
        $this->teamsService = $teamsService;
    }

    public function home()
    {
        $leagues = $this->leaguesService->paginate(4);
        $teams = $this->teamsService->paginate(4);

        return view('pages.home', compact(['leagues', 'teams']));
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function register()
    {
        return view('pages.auth.register');
    }
}
