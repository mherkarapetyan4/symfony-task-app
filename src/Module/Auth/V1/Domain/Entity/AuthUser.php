<?php

declare(strict_types=1);

namespace App\Module\Auth\V1\Domain\Entity;

use App\Module\Auth\V1\Infrastructure\Repository\AuthUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AuthUserRepository::class)]
#[ORM\Table(name: 'user')]
final class AuthUser implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private string $username;
    #[ORM\Column]
    private string $password;

    #[ORM\Column]
    private ?string $token;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        // Liskov principle violation
        return [];
    }

    public function eraseCredentials()
    {
        // Liskov principle violation
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->getId();
    }
}