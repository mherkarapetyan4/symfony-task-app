<?php

namespace App\Module\Comment\V1\Application\Action;

use App\Module\Comment\V1\Application\UseCase\Query\CommentByUserIndex\CommentByUserIndexQuery;
use App\Module\Comment\V1\Domain\Handler\CommentByUserIndexHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use OpenApi\Attributes as OA;
use Symfony\Component\Security\Core\Security;

final class CommentByUserIndexAction extends AbstractController
{
    #[Route(path: '/api/v1/comment/user', name: 'v1.comment.user.index', methods: ['GET'])]
    #[OA\Get(
        path: '/api/v1/comment/user',
        operationId: 'comment-by-user-index',
        summary: 'Comment list by user',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        tags: ['Comment'],
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
                                ref: '#/components/schemas/CommentDataObject',
                                description: 'CommentDataObject'
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
    public function run(Request $request, Security $security, CommentByUserIndexHandler $handler): JsonResponse
    {
        $commentUserIndexQuery = new CommentByUserIndexQuery(request: $request, security: $security);
        return new JsonResponse($handler->run($commentUserIndexQuery->getDto()));
    }
}