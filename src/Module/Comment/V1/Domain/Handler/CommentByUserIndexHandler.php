<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Domain\Handler;

use App\Module\Comment\V1\Application\UseCase\Query\CommentByUserIndex\CommentByUserIndexDto;
use App\Module\Comment\V1\Domain\Entity\Comment;
use App\Module\Comment\V1\Domain\Repository\ICommentRepository;
use App\Module\Comment\V1\Domain\View\CommentView;

final class CommentByUserIndexHandler
{
    public function __construct(
        private readonly ICommentRepository $repository,
        private readonly CommentView        $commentView
    )
    {
    }

    public function run(CommentByUserIndexDto $dto): array
    {
        $result = $this->repository->getAllByUser($dto);

        return [
            "data" => array_map(
                fn(Comment $task) => $this->commentView->map($task),
                $result
            )
        ];
    }
}