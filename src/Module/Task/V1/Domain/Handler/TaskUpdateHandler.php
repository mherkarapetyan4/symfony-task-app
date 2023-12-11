<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskUpdate\TaskUpdateDto;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Security;

final class TaskUpdateHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly ITaskRepository        $repository,
        private readonly Security               $security)
    {
    }

    /**
     * @param TaskUpdateDto $dto
     * @return array<array-key, string>
     */
    public function run(TaskUpdateDto $dto): array
    {

        $task = $this->repository->findOne($dto->getId());


        if (!$task) {
            // TODO:: Later replace this with custom domain exception
            throw new NotFoundHttpException("Task Not found");
        }

        $task->setTitle($dto->getTitle());
        $task->setDescription($dto->getDescription());
        $task->setUserId((int)$this->security->getToken()->getUserIdentifier());
        $task->setUpdatedAt(new DateTimeImmutable('now'));

        $this->em->persist($task);

        $this->em->flush();

        return [
            'message' => 'OK'
        ];
    }

}