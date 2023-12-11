<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Mutation\TaskStatus;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class TaskStatusMutation
{
    #[Assert\NotBlank]
    public int $id;


    #[Assert\Type('boolean')]
    #[Assert\NotNull]
    public ?bool $isDone;

    public function __construct(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $this->id = (int)$request->get('id');
        $this->isDone = $payload ? is_bool($payload['isDone']) ? $payload['isDone'] : (bool)$payload['isDone'] : null;
    }

    public function getDto(): TaskStatusDto
    {

        return new TaskStatusDto(
            id: $this->id,
            isDone: $this->isDone
        );
    }

}