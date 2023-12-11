<?php
declare(strict_types=1);

namespace App\Module\Auth\V1\Domain\Handler;

use App\Core\Service\JwtManager;
use App\Module\Auth\V1\Application\UseCase\Mutation\Login\LoginDto;
use App\Module\Auth\V1\Domain\Repository\IAuthUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class LoginHandler extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly IAuthUserRepository    $repository, private readonly JwtManager $jwtManager
    )
    {
    }

    public function run(LoginDto $dto): array
    {
        $user = $this->repository->findByUsername($dto->getUsername());

        if (!$user) {
            // TODO:: Later replace this with custom domain exception
            throw new NotFoundHttpException("User Not found");
        }


        // password check
        if (!password_verify($dto->getPassword(), $user->getPassword())) {
            throw new NotFoundHttpException("Password Not match");
        }

        $token = $this->jwtManager->generateToken(userId: $user->getId());

        $user->setToken($token);

        $this->em->persist($user);
        $this->em->flush();

        return ["token" => $token];
    }
}