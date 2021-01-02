<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\IUsersService;
use App\Http\Requests\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected IUsersService $userService;

    public function __construct(IUsersService $userService) 
    {
        $this->userService = $userService;
    }

    public function login(Login $request) 
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (($user = $this->userService->byEmail($email)) && Hash::check($password, $user->password)) {
            
            Auth::login($user);

            return response([
                'status'    => true,
                'data'      => $user
            ]);
        }

        return response([
            'status'    => false,
        ], 401);
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('site.home'));
    }
}
