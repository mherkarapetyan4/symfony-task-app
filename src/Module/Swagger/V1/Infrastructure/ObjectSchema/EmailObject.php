<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ObjectSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'EmailObject',
    type: 'string',
    example: 'test@mail.com'
)]
interface EmailObject
{
}
