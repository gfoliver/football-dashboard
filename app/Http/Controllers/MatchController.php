<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\IMatchesService;
use App\Core\Services\Contracts\ISeasonsService;
use App\Http\Requests\SaveMatch;
use Exception;

class MatchController extends Controller
{
    protected IMatchesService $service;
    private ISeasonsService $seasonsService;

    public function __construct(IMatchesService $service, ISeasonsService $seasonsService) {
        $this->service = $service;
        $this->seasonsService = $seasonsService;
    }

    public function form(string $slug, int $id)
    {
        $teams = $this->seasonsService->teams($id);

        return view('pages.leagues.match', compact(['slug', 'id', 'teams']));
    }

    public function save(SaveMatch $request)
    {
        try {
            $match = $this->service->save($request->all());

            return response([
                'status'    => true,
                'data'      => $match
            ]);
        }
        catch(Exception $e) {
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
