<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Domain\View;

use App\Module\Comment\V1\Domain\Entity\Comment;

class CommentView
{
    /**
     * @return array<array-key, string>
     */
    public function map(Comment $comment): array
    {
        return [
            "id" => $comment->getId(),
            "message" => $comment->getMessage(),
            "taskId" => $comment->getTaskId(),
            "userId" => $comment->getUserId()
        ];
    }
}