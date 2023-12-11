<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Mutation\TaskDelete;

use Symfony\Component\HttpFoundation\Request;

final class TaskDeleteMutation
{
    public int $id;

    public function __construct(Request $request)
    {
        $this->id = (int)$request->get('id');
    }

    public function getDto(): TaskDeleteDto
    {
        return new TaskDeleteDto(id: $this->id);
    }
}