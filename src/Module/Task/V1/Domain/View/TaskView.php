<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\View;

use App\Module\Task\V1\Domain\Entity\Task;

final class TaskView
{
    /**
     * @return array<array-key, string>
     */
    public function map(Task $task): array
    {
        return [
            "id" => $task->getId(),
            "title" => $task->getTitle(),
            "description" => $task->getDescription(),
            "isDone" => $task->isDone()
        ];
    }
}