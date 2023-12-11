<?php

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskStatus\TaskStatusDto;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskStatusHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly ITaskRepository        $repository
    )
    {
    }

    /**
     * @param TaskStatusDto $dto
     * @return array<array-key, string>
     */
    public function run(TaskStatusDto $dto): array
    {
        $task = $this->repository->findOne($dto->getId());

        if (!$task) {
            // TODO:: Later replace this with custom domain exception
            throw new NotFoundHttpException("Task Not found");
        }

        $task->setIsDone($dto->isDone());
        $task->setCompletedAt(new DateTimeImmutable('now'));
        $task->setUpdatedAt(new DateTimeImmutable('now'));

        $this->em->persist($task);

        $this->em->flush();

        return [
            'message' => 'OK'
        ];
    }
}