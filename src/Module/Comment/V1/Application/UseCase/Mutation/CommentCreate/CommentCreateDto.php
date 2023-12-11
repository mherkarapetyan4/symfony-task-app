<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Application\UseCase\Mutation\CommentCreate;

final class CommentCreateDto
{
    public function __construct(
        private readonly string $message,
        private readonly int    $taskId,
    )
    {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }
}