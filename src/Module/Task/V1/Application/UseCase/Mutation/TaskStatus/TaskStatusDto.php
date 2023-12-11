<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Mutation\TaskStatus;

final class TaskStatusDto
{
    public function __construct(
        private readonly int  $id,
        private readonly bool $isDone,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }
}