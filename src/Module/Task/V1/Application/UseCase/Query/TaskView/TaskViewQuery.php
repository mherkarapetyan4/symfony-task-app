<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Query\TaskView;

use Symfony\Component\HttpFoundation\Request;

final class TaskViewQuery
{
    public int $id;

    public function __construct(Request $request)
    {
        $this->id = (int)$request->get('id');
    }

    public function getDto(): TaskViewDto
    {
        return new TaskViewDto(id: $this->id);
    }
}