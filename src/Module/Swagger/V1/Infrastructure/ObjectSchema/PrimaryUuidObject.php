<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ObjectSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PrimaryUuidObject',
    description: 'uuid',
    type: 'string',
    example: 'a88417a8-946d-42e6-b973-49ddd61f694e'
)]
interface PrimaryUuidObject
{
}
