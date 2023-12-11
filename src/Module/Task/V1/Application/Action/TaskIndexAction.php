<?php

declare(strict_types=1);

namespace App\Module\Task\V1\Application\Action;

use App\Module\Task\V1\Application\UseCase\Query\TaskIndex\TaskIndexQuery;
use App\Module\Task\V1\Domain\Handler\TaskIndexHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use OpenApi\Attributes as OA;

final class TaskIndexAction extends AbstractController
{
    #[Route(path: '/api/v1/task', name: 'v1.task.getAll', methods: ['GET'])]
    #[OA\Get(
        path: '/api/v1/task',
        operationId: 'task-index',
        summary: 'Task list',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        tags: ['Task'],
        parameters: [
            new OA\QueryParameter(
                ref: '#/components/parameters/general--page'
            ),
            new OA\QueryParameter(
                ref: '#/components/parameters/general--limit'
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    required: ['data'],
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/TaskDataObject',
                                description: 'TaskDataObject'
                            ),
                        ),
                    ]
                )
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
    public function run(Request $request, TaskIndexHandler $handler): JsonResponse
    {
        $taskIndexQuery = new TaskIndexQuery($request);

        return new JsonResponse($handler->run($taskIndexQuery->getDto()));
    }
}