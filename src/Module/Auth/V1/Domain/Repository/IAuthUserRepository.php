<?php

declare(strict_types=1);

namespace App\Module\Auth\V1\Domain\Repository;

use App\Module\Auth\V1\Domain\Entity\AuthUser;

interface IAuthUserRepository
{
    public function findByUsername(string $username): ?AuthUser;

    public function findByIdAndToken(int $id, string $token): ?AuthUser;
}