<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Infrastructure\Repository;

use App\Module\Comment\V1\Application\UseCase\Query\CommentByTaskIndex\CommentByTaskIndexDto;
use App\Module\Comment\V1\Application\UseCase\Query\CommentByUserIndex\CommentByUserIndexDto;
use App\Module\Comment\V1\Domain\Entity\Comment;
use App\Module\Comment\V1\Domain\Repository\ICommentRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommentRepository extends ServiceEntityRepository implements ICommentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function getAllByTask(CommentByTaskIndexDto $dto): array
    {
        return $this->findBy(criteria: ["taskId" => $dto->getTaskId()], limit: $dto->getLimit(), offset: $dto->getOffset());
    }

    public function getAllByUser(CommentByUserIndexDto $dto): array
    {
        return $this->findBy(criteria: ["userId" => $dto->getUserId()], limit: $dto->getLimit(), offset: $dto->getOffset());
    }
}