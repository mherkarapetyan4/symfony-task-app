<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Mutation\TaskCreate;

final class TaskCreateDto
{
    public function __construct(
        private readonly string $title,
        private readonly string $description
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}