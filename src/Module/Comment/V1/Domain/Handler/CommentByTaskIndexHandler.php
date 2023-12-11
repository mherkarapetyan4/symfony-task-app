<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Domain\Handler;

use App\Module\Comment\V1\Application\UseCase\Query\CommentByTaskIndex\CommentByTaskIndexDto;
use App\Module\Comment\V1\Domain\Entity\Comment;
use App\Module\Comment\V1\Domain\Repository\ICommentRepository;
use App\Module\Comment\V1\Domain\View\CommentView;

class CommentByTaskIndexHandler
{
    public function __construct(
        private readonly ICommentRepository $repository,
        private readonly CommentView        $commentView
    )
    {
    }

    public function run(CommentByTaskIndexDto $dto): array
    {
        $result = $this->repository->getAllByTask($dto);

        return [
            "data" => array_map(
                fn(Comment $task) => $this->commentView->map($task),
                $result
            )
        ];
    }
}