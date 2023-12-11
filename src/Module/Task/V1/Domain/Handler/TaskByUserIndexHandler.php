<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Query\TaskByUserIndex\TaskByUserIndexDto;
use App\Module\Task\V1\Domain\Entity\Task;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use App\Module\Task\V1\Domain\View\TaskView;

class TaskByUserIndexHandler
{
    public function __construct(
        private readonly ITaskRepository $repository,
        private readonly TaskView        $taskView
    )
    {
    }

    public function run(TaskByUserIndexDto $dto): array
    {
        $result = $this->repository->getAllByUser($dto);

        return [
            "data" => array_map(
                fn(Task $task) => $this->taskView->map($task),
                $result
            )
        ];
    }
}