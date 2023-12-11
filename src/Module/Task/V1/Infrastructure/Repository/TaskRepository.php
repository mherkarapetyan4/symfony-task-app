<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Infrastructure\Repository;

use App\Module\Task\V1\Application\UseCase\Query\TaskByUserIndex\TaskByUserIndexDto;
use App\Module\Task\V1\Application\UseCase\Query\TaskIndex\TaskIndexDto;
use App\Module\Task\V1\Domain\Repository\ITaskRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Module\Task\V1\Domain\Entity\Task;

class TaskRepository extends ServiceEntityRepository implements ITaskRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findOne(int $id): ?Task
    {
        return $this->find($id);
    }

    public function getAll(TaskIndexDto $dto): array
    {
        return $this->findBy(criteria: [], limit: $dto->getLimit(), offset: $dto->getOffset());
    }

    public function getAllByUser(TaskByUserIndexDto $dto): array
    {
        return $this->findBy(criteria: ["userId" => $dto->getUserId()], limit: $dto->getLimit(), offset: $dto->getOffset());
    }
}