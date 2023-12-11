<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\Action;

use App\Module\Task\V1\Application\UseCase\Query\TaskView\TaskViewQuery;
use App\Module\Task\V1\Domain\Handler\TaskViewHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class TaskViewAction extends AbstractController
{

    #[Route(path: '/api/v1/task/{id}', name: 'v1.task.getOne', methods: ['GET'])]
    #[OA\Get(
        path: '/api/v1/task/{id}',
        operationId: 'task-find-one',
        summary: 'Get Task',
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
                content: new OA\JsonContent(
                    ref: '#/components/schemas/TaskDataObject',
                    description: 'TaskDataObject',
                ),
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
    public function run(Request $request, TaskViewHandler $handler): JsonResponse
    {
        $taskQuery = new TaskViewQuery($request);

        return new JsonResponse($handler->run($taskQuery->getDto()));
    }
}