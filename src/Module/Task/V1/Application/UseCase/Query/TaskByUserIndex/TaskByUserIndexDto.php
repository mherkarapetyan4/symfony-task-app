<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Query\TaskByUserIndex;

final class TaskByUserIndexDto
{
    public function __construct(
        private readonly int $offset,
        private readonly int $limit,
        private readonly int $userId
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

    public function getUserId(): int
    {
        return $this->userId;
    }
}