<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ParameterSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'SortParameterObject',
    description: 'By default sort is asc',
    type: 'string',
    default: 'asc',
    enum: ['asc', 'desc']
)]
interface SortParameterObject
{
}
