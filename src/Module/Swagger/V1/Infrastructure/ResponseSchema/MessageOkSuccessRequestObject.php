<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ResponseSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'MessageOkSuccessRequestObject',
    required: ['message'],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'OK'
        ),
    ],
    type: 'object'
)]
interface MessageOkSuccessRequestObject
{
}
