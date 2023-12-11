<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Handler;

use App\Module\Task\V1\Application\UseCase\Query\TaskIndex\TaskIndexDto;
use App\Module\Task\V1\Domain\Entity\Task;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use App\Module\Task\V1\Domain\View\TaskView;

class TaskIndexHandler
{
    public function __construct(
        private readonly ITaskRepository $repository,
        private readonly TaskView        $taskView
    )
    {
    }

    public function run(TaskIndexDto $dto): array
    {
        $result = $this->repository->getAll($dto);

        return [
            "data" => array_map(
                fn(Task $task) => $this->taskView->map($task),
                $result
            )
        ];
    }
}