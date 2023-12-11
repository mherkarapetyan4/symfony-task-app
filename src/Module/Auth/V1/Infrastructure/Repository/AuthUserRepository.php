<?php
declare(strict_types=1);

namespace App\Module\Auth\V1\Infrastructure\Repository;

use App\Module\Auth\V1\Domain\Entity\AuthUser;
use App\Module\Auth\V1\Domain\Repository\IAuthUserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class AuthUserRepository extends ServiceEntityRepository implements IAuthUserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthUser::class);
    }

    public function findByUsername(string $username): ?AuthUser
    {
        return $this->findOneBy(criteria: ["username" => $username]);
    }

    public function findByIdAndToken(int $id, string $token): ?AuthUser
    {
        return $this->findOneBy(criteria: ["id" => $id, "token" => $token]);
    }
}