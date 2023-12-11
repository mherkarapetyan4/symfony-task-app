<?php
declare(strict_types=1);

namespace App\Module\Task\V1\Application\UseCase\Mutation\TaskCreate;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class TaskCreateMutation
{
    #[NotBlank]
    #[Length(min: 3, minMessage: "Should be at least 3 chars")]
    public ?string $title;

    #[NotBlank]
    #[Length(min: 3, minMessage: "Should be at least 3 chars")]
    public ?string $description;

    public function __construct(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        $this->title = $payload['title'] ?? null;
        $this->description = $payload['description'] ?? null;
    }

    public function getDto(): TaskCreateDto
    {
        return new TaskCreateDto(
            title: $this->title,
            description: $this->description
        );
    }
}