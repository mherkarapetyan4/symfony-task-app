<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Entity;

use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: ITaskRepository::class)]
#[ORM\Table(name: 'task')]
#[OA\Schema(
    schema: 'TaskDataObject',
    required: [
        'id',
        'title',
        'description',
        'userId',
        'isDone',
        'completedAt',
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
final class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'title', type: Types::STRING, length: 255)]
    private string $title;

    #[ORM\Column(name: 'description', type: Types::STRING, length: 255)]
    private string $description;

    #[ORM\Column(name: 'completed_at', type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private null|DateTimeImmutable $completedAt = null;

    #[ORM\Column(name: 'is_done', type: 'boolean')]
    private bool $isDone = false;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE)]
    public DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_IMMUTABLE)]
    public DateTimeImmutable $updatedAt;

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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCompletedAt(): DateTimeImmutable|null
    {
        return $this->completedAt;
    }

    public function setCompletedAt(DateTimeImmutable|null $completedAt): void
    {
        $this->completedAt = $completedAt;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): void
    {
        $this->isDone = $isDone;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
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