<?php

declare(strict_types=1);

namespace App\Module\Auth\V1\Application\UseCase\Mutation\Login;

final class LoginDto
{
    public function __construct(
        private readonly string $username,
        private readonly string $password,
        private readonly string $token
    )
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}