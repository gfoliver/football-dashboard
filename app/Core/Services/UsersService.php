<?php

namespace App\Core\Services;

use App\Core\Services\Contracts\IUsersService;
use App\Core\Entities\User;
use App\Core\Repositories\Contracts\IUsersRepository;

class UsersService implements IUsersService {
    protected IUsersRepository $repository;
    
    public function __construct(IUsersRepository $repository) 
    {
        $this->repository = $repository;
    }

    public function save(array $data): ?User
    {
        return $this->repository->save($data);
    }

    public function delete(int $id): Bool
    {
        return $this->repository->delete($id);
    }

    public function byId(int $id): ?User
    {
        return $this->repository->byId($id);
    }

    public function byEmail(string $email): ?User
    {
        return $this->repository->byEmail($email);
    }
}
