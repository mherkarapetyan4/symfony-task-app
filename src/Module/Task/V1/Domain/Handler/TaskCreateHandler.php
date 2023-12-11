<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskCreate\TaskCreateDto;
use App\Module\Task\V1\Domain\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

final class TaskCreateHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly Security               $security
    )
    {
    }

    /**
     * @param TaskCreateDto $dto
     * @return array<array-key, string>
     */
    public function run(TaskCreateDto $dto): array
    {
        $task = new Task();

        $task->setTitle($dto->getTitle());
        $task->setDescription($dto->getDescription());
        $task->setUserId((int)$this->security->getToken()->getUserIdentifier());
        $task->setCreatedAt(new \DateTimeImmutable('now'));
        $this->em->persist($task);

        $this->em->flush();

        return [
            'message' => 'OK'
        ];
    }
}