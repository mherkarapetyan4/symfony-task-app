<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskDelete\TaskDeleteDto;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class TaskDeleteHandler
{
    public function __construct(
        private readonly ITaskRepository        $repository,
        private readonly EntityManagerInterface $em
    )
    {
    }

    /**
     * @param TaskDeleteDto $dto
     * @return array<array-key, string>
     */
    public function run(TaskDeleteDto $dto): array
    {
        $task = $this->repository->findOne($dto->getId());

        if (!$task) {
            // TODO:: Later replace this with custom domain exception
            throw new NotFoundHttpException("Task Not found");
        }

        $this->em->remove($task);
        $this->em->flush();

        return [
            "message" => "ok"
        ];
    }
}