<?php

declare(strict_types=1);

namespace App\Module\Comment\V1\Application\Action;

use App\Module\Comment\V1\Application\UseCase\Mutation\CommentCreate\CommentCreateMutation;
use App\Module\Comment\V1\Domain\Handler\CommentCreateHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CommentCreateAction extends AbstractController
{
    #[Route(path: '/api/v1/comment', name: 'v1.comment.create', methods: ['POST'])]
    #[OA\Post(
        path: '/api/v1/comment',
        operationId: 'comment-create',
        summary: 'Comment',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['message', 'parentId'],
                properties: [
                    new OA\Property(
                        property: 'message',
                        type: 'string',
                        example: 'Test Title'
                    ),
                    new OA\Property(
                        property: 'taskId',
                        type: 'int',
                        example: 1
                    ),
                ]
            )
        ),
        tags: ['Comment'],
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
    public function run(Request $request, ValidatorInterface $validator, CommentCreateHandler $handler): JsonResponse
    {
        $commentCreateMutation = new CommentCreateMutation($request);

        $errors = $validator->validate($commentCreateMutation);

        if (count($errors) > 0) {
            return new JsonResponse(
                [
                    'error' => [
                        $errors[0]?->getPropertyPath() => $errors[0]->getMessage()
                    ]
                ]
            );
        }
        return new JsonResponse($handler->run($commentCreateMutation->getDto()));
    }
}