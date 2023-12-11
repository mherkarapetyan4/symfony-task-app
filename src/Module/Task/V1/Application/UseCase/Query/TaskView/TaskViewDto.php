<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Query\TaskView;

final class TaskViewDto
{
    public function __construct(private readonly int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}