<?php

declare(strict_types=1);

namespace App\Module\Auth\V1\Application\UseCase\Mutation\Login;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class LoginMutation
{
    #[Assert\NotBlank]
    public ?string $username;

    #[Assert\NotBlank]
    public ?string $password;

    public ?string $token;

    public function __construct(Request $request)
    {
        $payload = json_decode($request->getContent(), true);

        $this->username = $payload ? $payload['username'] ?? null : null;
        $this->password = $payload ? $payload['password'] ?? null : null;
    }

    public function getDto(): LoginDto
    {
        return new LoginDto(
            username: $this->username,
            password: $this->password,
            token: 'jwt'
        );
    }
}