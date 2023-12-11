<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Application\UseCase\Query\CommentByTaskIndex;

use Symfony\Component\HttpFoundation\Request;

class CommentByTaskIndexQuery
{
    public int $offset;
    public int $limit;
    public int $taskId;

    public function __construct(Request $request)
    {
        $this->taskId = (int)$request->get('id');
        $this->offset = (int)$request->get('offset');
        $this->limit = (int)$request->get('limit') === 0 ? 2 : (int)$request->get('limit');
    }

    public function getDto(): CommentByTaskIndexDto
    {
        return new CommentByTaskIndexDto(
            offset: $this->offset,
            limit: $this->limit,
            taskId: $this->taskId
        );
    }

}