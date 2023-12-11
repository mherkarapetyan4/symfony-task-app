<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Query\TaskIndex;

final class TaskIndexDto
{
    public function __construct(
        private readonly int $offset,
        private readonly int $limit
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
}