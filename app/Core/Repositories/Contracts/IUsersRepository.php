<?php 

namespace App\Core\Repositories\Contracts;

use App\Core\Entities\User;

interface IUsersRepository {
    public function save(array $data): ?User;

    public function delete(int $id): Bool;

    public function byId(int $id): ?User;

    public function byEmail(string $email): ?User;
}