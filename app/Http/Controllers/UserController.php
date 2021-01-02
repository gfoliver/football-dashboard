<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\IUsersService;
use App\Http\Requests\SaveUser;
use Exception;

class UserController extends Controller
{
    protected IUsersService $service;

    public function __construct(IUsersService $service) {
        $this->service = $service;
    }

    public function save(SaveUser $request)
    {
        try {
            $user = $this->service->save($request->all());
            
            return response([
                'status'    => true,
                'data'      => $user
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
            'status'    => $deleted,
        ], $deleted ? 200 : 400);
    }
}
