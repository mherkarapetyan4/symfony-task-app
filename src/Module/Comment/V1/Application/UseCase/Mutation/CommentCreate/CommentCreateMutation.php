<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Application\UseCase\Mutation\CommentCreate;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


final class CommentCreateMutation
{
    #[NotBlank]
    #[Length(min: 3, minMessage: "Should be at least 3 chars")]
    public ?string $message;

    #[NotBlank]
    public ?int $taskId;

    public function __construct(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        $this->message = $payload['message'] ?? null;
        $this->taskId = $payload['taskId'] ?? null;
    }

    public function getDto(): CommentCreateDto
    {
        return new CommentCreateDto(
            message: $this->message,
            taskId: $this->taskId
        );
    }
}