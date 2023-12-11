<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Domain\Handler;

use App\Module\Comment\V1\Application\UseCase\Mutation\CommentCreate\CommentCreateDto;
use App\Module\Comment\V1\Domain\Entity\Comment;

use App\Module\Task\V1\Infrastructure\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Security;

final class CommentCreateHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly Security               $security,
        private readonly TaskRepository         $taskRepository
    )
    {
    }

    /**
     * @param CommentCreateDto $dto
     * @return array<array-key, string>
     */
    public function run(CommentCreateDto $dto): array
    {
        $task = $this->taskRepository->findOne($dto->getTaskId());

        if (!$task) {
            throw new NotFoundHttpException("Task is not found");
        }

        $comment = new Comment();

        $comment->setMessage($dto->getMessage());
        $comment->setTaskId($dto->getTaskId());
        $comment->setUserId((int)$this->security->getToken()->getUserIdentifier());

        $this->em->persist($comment);

        $this->em->flush();

        return [
            'message' => 'OK'
        ];
    }
}