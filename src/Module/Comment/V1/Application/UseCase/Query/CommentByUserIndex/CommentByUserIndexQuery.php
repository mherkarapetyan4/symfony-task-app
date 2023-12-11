<?php

namespace App\Module\Comment\V1\Application\UseCase\Query\CommentByUserIndex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

final class CommentByUserIndexQuery
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

    public function getDto(): CommentByUserIndexDto
    {
        return new CommentByUserIndexDto(
            offset: $this->offset,
            limit: $this->limit,
            userId: (int)$this->security->getUser()->getUserIdentifier()
        );
    }
}