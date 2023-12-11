<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ResponseSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ForbiddenObject',
    required: ['name', 'message', 'code', 'status', 'type'],
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'Forbidden'
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'You dont have access to this page'
        ),
        new OA\Property(
            property: 'code',
            type: 'integer',
            example: 0
        ),
        new OA\Property(
            property: 'status',
            type: 'integer',
            example: 401
        ),
        new OA\Property(
            property: 'type',
            type: 'string',
        ),
    ],
    type: 'object'
)]
interface ForbiddenObject
{
}
