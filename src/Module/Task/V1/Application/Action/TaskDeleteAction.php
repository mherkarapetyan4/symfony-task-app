<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\Action;

use App\Module\Task\V1\Application\UseCase\Mutation\TaskDelete\TaskDeleteMutation;
use App\Module\Task\V1\Domain\Handler\TaskDeleteHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use OpenApi\Attributes as OA;

final class TaskDeleteAction extends AbstractController
{
    #[Route(path: '/api/v1/task/{id}', name: 'v1.task.deleteOne', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/api/v1/task/{id}',
        operationId: 'task-delete-one',
        summary: 'Delete Task',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        tags: ['Task'],
        parameters: [
            new OA\PathParameter(
                name: 'id',
                required: true,
                example: 12
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: null,
            ),
            new OA\Response(
                response: 400,
                description: 'Bad Request',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/BadRequestObject'
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthorized',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/UnauthorizedObject'
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Server Error',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ServerErrorObject'
                )
            ),
        ]
    )]
    public function run(Request $request, TaskDeleteHandler $handler): JsonResponse
    {
        $taskMutation = new TaskDeleteMutation($request);

        return new JsonResponse($handler->run($taskMutation->getDto()));
    }
}