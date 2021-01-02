<?php 

namespace App\Core\Repositories;

use App\Core\Entities\User;
use App\Core\Repositories\Contracts\IUsersRepository;
use Illuminate\Support\Facades\Hash;

class UsersRepository implements IUsersRepository {
    public function save(array $data): ?User 
    {
        $userData = [
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password'])
        ];

        if (isset($data['id'])) {
            $user = User::find($data['id']);

            $user->fill($userData);
            $user->save();

            return $user;
        }

        $user = User::create($userData);
        
        return $user;
    }

    public function delete(int $id): Bool 
    {
        return User::find($id)->delete();
    }

    public function byId(int $id): ?User 
    {
        return User::find($id);
    }

    public function byEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}