<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\Action;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskStatus\TaskStatusMutation;
use App\Module\Task\V1\Domain\Handler\TaskStatusHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class TaskStatusAction extends AbstractController
{
    #[Route(path: '/api/v1/task/{id}', name: 'v1.task.status.update', methods: ['PATCH'])]
    #[OA\Patch(
        path: '/api/v1/task/{id}',
        operationId: 'task-status-update',
        summary: 'Task status update',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['isDone'],
                properties: [
                    new OA\Property(
                        property: 'isDone',
                        type: 'bool',
                        example: false
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
    public function run(Request $request, ValidatorInterface $validator, TaskStatusHandler $handler): JsonResponse
    {
        $taskStatusMutation = new TaskStatusMutation($request);

        $errors = $validator->validate($taskStatusMutation);

        if (count($errors) > 0) {
            return new JsonResponse(
                [
                    'error' => [
                        $errors[0]?->getPropertyPath() => $errors[0]->getMessage()
                    ]
                ]
            );
        }

        return new JsonResponse($handler->run($taskStatusMutation->getDto()));
    }
}