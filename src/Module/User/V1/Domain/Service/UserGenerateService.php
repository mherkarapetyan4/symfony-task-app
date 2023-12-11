<?php

declare(strict_types=1);

namespace App\Module\User\V1\Domain\Service;

use App\Module\User\V1\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class UserGenerateService
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function run(): void
    {
        $usersCount = $this->em->getRepository(User::class)->count(criteria: []);

        if ($usersCount) {
            return;
        }

        foreach (range(1, 5) as $idx) {
            $user = new User();

            $user->setUsername("user_$idx");
            $user->setPassword(password_hash("password", PASSWORD_BCRYPT, ["cost" => 15]));

            $this->em->persist($user);
        }

        $this->em->flush();
    }
}