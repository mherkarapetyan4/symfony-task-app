<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\Action;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskUpdate\TaskUpdateMutation;
use App\Module\Task\V1\Domain\Handler\TaskUpdateHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class TaskUpdateAction extends AbstractController
{
    #[Route(path: '/api/v1/task/{id}', name: 'v1.task.update', methods: ['PUT'])]
    #[OA\Put(
        path: '/api/v1/task/{id}',
        operationId: 'task-update',
        summary: 'Task',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['title', 'description', 'userId'],
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string',
                        example: 'Test Title'
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                        example: 'Lorem...'
                    ),
                    new OA\Property(
                        property: 'userId',
                        type: 'int',
                        example: 1
                    ),
                ]
            )
        ),
        tags: ['Task'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success Request',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/MessageOkSuccessRequestObject'
                )
            ),
        ]
    )]
    public function run(Request $request, ValidatorInterface $validator, TaskUpdateHandler $handler): JsonResponse
    {
        $taskCreateMutation = new TaskUpdateMutation($request);

        $errors = $validator->validate($taskCreateMutation);

        if (count($errors) > 0) {
            return new JsonResponse(
                [
                    'error' => [
                        $errors[0]?->getPropertyPath() => $errors[0]->getMessage()
                    ]
                ]
            );
        }

        return new JsonResponse(
            $handler->run($taskCreateMutation->getDto())
        );
    }
}