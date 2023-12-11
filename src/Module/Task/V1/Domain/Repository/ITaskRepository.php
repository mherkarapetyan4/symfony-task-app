<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Domain\Repository;

use App\Module\Task\V1\Application\UseCase\Query\TaskByUserIndex\TaskByUserIndexDto;
use App\Module\Task\V1\Application\UseCase\Query\TaskIndex\TaskIndexDto;
use App\Module\Task\V1\Domain\Entity\Task;

interface ITaskRepository
{
    /**
     * @param TaskIndexDto $dto
     * @return array<array-key, Task>
     */
    public function getAll(TaskIndexDto $dto): array;

    /**
     * @param TaskByUserIndexDto $dto
     * @return array<array-key, Task>
     */
    public function getAllByUser(TaskByUserIndexDto $dto): array;

    public function findOne(int $id): ?Task;
}