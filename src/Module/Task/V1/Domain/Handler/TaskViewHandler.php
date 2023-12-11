<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Query\TaskView\TaskViewDto;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use App\Module\Task\V1\Domain\View\TaskView;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class TaskViewHandler
{
    public function __construct(
        private readonly ITaskRepository $repository,
        private readonly TaskView        $taskView
    )
    {
    }

    public function run(TaskViewDto $dto): array
    {
        $task = $this->repository->findOne($dto->getId());

        if (!$task) {
            // TODO:: Later replace this with custom domain exception
            throw new NotFoundHttpException("Task Not found");
        }

        return [
            "data" => $this->taskView->map($task)
        ];
    }
}