<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Mutation\TaskUpdate;

final class TaskUpdateDto
{
    public function __construct(
        private readonly int    $id,
        private readonly string $title,
        private readonly string $description,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
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