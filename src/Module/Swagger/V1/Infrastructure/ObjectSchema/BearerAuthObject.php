<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ObjectSchema;

use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    name: 'bearerAuth',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'Bearer'
)]
interface BearerAuthObject
{
}
