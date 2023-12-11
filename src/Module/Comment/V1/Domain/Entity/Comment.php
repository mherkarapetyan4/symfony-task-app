<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Domain\Entity;

use App\Module\Comment\V1\Infrastructure\Repository\CommentRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: 'comment')]
#[OA\Schema(
    schema: 'CommentDataObject',
    required: [
        'id',
        'message',
        'createdAt',
        'taskId',
    ],
    properties: [
        new OA\Property(
            property: 'id',
            type: 'int',
            example: 1,
        ),
        new OA\Property(
            property: 'title',
            type: 'string',
            example: 'My Task'
        ),
        new OA\Property(
            property: 'description',
            type: 'string',
            example: 'My task description'
        ),
        new OA\Property(
            property: 'userId',
            type: 'int',
            example: 1
        ),
        new OA\Property(
            property: 'isDone',
            type: 'bool',
            example: false
        ),
        new OA\Property(
            property: 'completedAt',
            ref: '#/components/schemas/DateObject'
        ),
    ],
    type: 'object'
)]
final class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'message', type: Types::STRING, length: 255)]
    private ?string $message;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private null|DateTime $updatedAt;

    #[ORM\Column(name: 'task_id', type: Types::INTEGER)]
    private int $taskId;

    #[ORM\Column(name: 'user_id', type: Types::INTEGER)]
    private int $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function setTaskId(int $taskId): void
    {
        $this->taskId = $taskId;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}