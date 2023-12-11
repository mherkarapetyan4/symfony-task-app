<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ObjectSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PrimaryIdObject',
    type: 'integer',
    example: 1
)]
interface PrimaryIdObject
{
}
