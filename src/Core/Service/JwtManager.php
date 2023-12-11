<?php

namespace App\Core\Service;

use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Validator;

class JwtManager
{
    private readonly Builder $tokenBuilder;
    private readonly Sha256 $algorithm;
    private readonly InMemory $signingKey;
    private readonly DateTimeImmutable $time;


    public function __construct(private readonly string $jwtKey)
    {
        $this->tokenBuilder = new Builder(new JoseEncoder(), ChainedFormatter::default());
        $this->algorithm = new Sha256();
        $this->signingKey = InMemory::plainText($this->jwtKey);
        $this->time = new DateTimeImmutable();
    }

    public function generateToken(int $userId): string
    {
        $token = $this->tokenBuilder
            ->issuedAt($this->time)
            ->issuedBy('test')
            ->expiresAt($this->time->modify('+' . '1 hour'))
            ->withClaim('uid', $userId)
            ->withClaim('rand', time() . rand(1, 1000))
            ->getToken($this->algorithm, $this->signingKey);

        return $token->toString();
    }

    public function isValid(string $jwt): bool
    {
        try {
            $parser = new Parser(new JoseEncoder());
            $token = $parser->parse($jwt);
            $validator = new Validator();

            if (!$validator->validate($token, new IssuedBy('test'))) {
                return false;
            }
        } catch (\Exception) {
            return false;
        }


        return !$token->isExpired($this->time);
    }

    public function getUserIdFromToken(string $jwt): ?int
    {
        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($jwt);

        assert($token instanceof UnencryptedToken);

        if (!$token->claims()->has('uid')) {
            return null;
        }

        return $this->getIntValue($token->claims()->get('uid'));
    }

    private function getIntValue(mixed $value): ?int
    {
        if (is_int($value)) {
            return $value;
        }

        return null;
    }
}