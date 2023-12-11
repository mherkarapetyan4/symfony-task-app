<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Application\UseCase\Query\CommentByTaskIndex;

class CommentByTaskIndexDto
{
    public function __construct(
        private readonly int $offset,
        private readonly int $limit,
        private readonly int $taskId
    )
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }
}