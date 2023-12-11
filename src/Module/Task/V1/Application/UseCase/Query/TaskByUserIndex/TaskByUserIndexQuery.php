<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Query\TaskByUserIndex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

final class TaskByUserIndexQuery
{
    public int $offset;
    public int $limit;
    public int $userId;

    public function __construct(
        Request                   $request,
        private readonly Security $security
    )
    {
        $this->offset = (int)$request->get('offset');
        $this->limit = (int)$request->get('limit') === 0 ? 2 : (int)$request->get('limit');
    }

    public function getDto(): TaskByUserIndexDto
    {
        return new TaskByUserIndexDto(
            offset: $this->offset,
            limit: $this->limit,
            userId: (int)$this->security->getUser()->getUserIdentifier()
        );
    }
}