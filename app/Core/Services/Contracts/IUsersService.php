<?php 

namespace App\Core\Services\Contracts;

use App\Core\Entities\User;

interface IUsersService {
    public function save(array $data): ?User;

    public function delete(int $id): Bool;

    public function byId(int $id): ?User;

    public function byEmail(string $email): ?User;
}