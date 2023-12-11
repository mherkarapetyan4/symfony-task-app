<?php

declare(strict_types=1);

namespace App\Module\Auth\V1\Application\Action;

use App\Module\Auth\V1\Application\UseCase\Mutation\Login\LoginMutation;
use App\Module\Auth\V1\Domain\Handler\LoginHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[OA\Server(url: "http://localhost/")]
final class LoginAction extends AbstractController
{
    #[Route(path: '/api/v1/auth/login', name: 'v1.auth.login', methods: ['POST'])]

    #[OA\Post(
        path: '/api/v1/auth/login',
        operationId: 'websites-user-create',
        summary: 'Auth login',
        security: [
            [
                'bearerAuth' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['username', 'password'],
                properties: [
                    new OA\Property(
                        property: 'username',
                        type: 'string',
                        example: 'user_1'
                    ),
                    new OA\Property(
                        property: 'password',
                        type: 'string',
                        example: 'password'
                    ),
                ]
            )
        ),
        tags: ['Auth'],
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
    public function run(Request $request, ValidatorInterface $validator, LoginHandler $handler): JsonResponse
    {
        $loginMutation = new LoginMutation($request);

        $errors = $validator->validate($loginMutation);

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
            $handler->run($loginMutation->getDto())
        );
    }
}