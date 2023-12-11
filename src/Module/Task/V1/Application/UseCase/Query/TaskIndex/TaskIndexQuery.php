<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Query\TaskIndex;

use Symfony\Component\HttpFoundation\Request;

final class TaskIndexQuery
{
    public int $offset;
    public int $limit;

    public function __construct(Request $request)
    {
        $this->offset = (int)$request->get('offset');
        $this->limit = (int)$request->get('limit') === 0 ? 2 : (int)$request->get('limit');
    }

    public function getDto(): TaskIndexDto
    {
        return new TaskIndexDto(
            offset: $this->offset,
            limit: $this->limit
        );
    }
}