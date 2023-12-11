<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ResponseSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ServerErrorObject',
    required: ['name', 'message', 'code', 'status', 'type'],
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'Internal Server Error'
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Something went wrong!'
        ),
        new OA\Property(
            property: 'code',
            type: 'integer',
            example: 0
        ),
        new OA\Property(
            property: 'status',
            type: 'integer',
            example: 500
        ),
        new OA\Property(
            property: 'type',
            type: 'string',
        ),
    ],
    type: 'object'
)]
interface ServerErrorObject
{
}
