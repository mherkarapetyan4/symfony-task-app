<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ObjectSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'GridObject',
    required: ['count', 'paginator'],
    properties: [
        new OA\Property(
            property: 'count',
            type: 'integer',
            example: 100
        ),
        new OA\Property(
            property: 'paginator',
            required: ['limit', 'page'],
            properties: [
                new OA\Property(
                    property: 'limit',
                    type: 'integer',
                    example: 10
                ),
                new OA\Property(
                    property: 'page',
                    type: 'integer',
                    example: 1
                ),
            ],
            type: 'object'
        ),
    ],
    type: 'object'
)]
interface GridObject
{
}
