<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\ITeamsService;
use Exception;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    private ITeamsService $service;

    public function __construct(ITeamsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $teams = $this->service->list();

        return view('pages.teams.list', compact('teams'));
    }

    public function form(int $id = null)
    {
        $team = null;

        if ($id) {
            $team = $this->service->byId($id);
        }

        return view('pages.teams.form', compact(['id', 'team']));
    }

    public function save(Request $request)
    {
        try {
            $team = $this->service->save($request->all());

            return response([
                'status'    => true,
                'data'      => $team
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
