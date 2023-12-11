<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Domain\Repository;

use App\Module\Comment\V1\Application\UseCase\Query\CommentByTaskIndex\CommentByTaskIndexDto;
use App\Module\Comment\V1\Application\UseCase\Query\CommentByUserIndex\CommentByUserIndexDto;
use App\Module\Comment\V1\Domain\Entity\Comment;

interface ICommentRepository
{
    /**
     * @param CommentByTaskIndexDto $dto
     * @return array<array-key, Comment>
     */
    public function getAllByTask(CommentByTaskIndexDto $dto): array;

    /**
     * @param CommentByUserIndexDto $dto
     * @return array<array-key, Comment>
     */
    public function getAllByUser(CommentByUserIndexDto $dto): array;
}