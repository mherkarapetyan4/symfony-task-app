<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ParameterSchema;

use OpenApi\Attributes as OA;

#[OA\QueryParameter(
    parameter: 'general--page',
    name: 'offset',
    description: 'The current page for the result set, defaults to *1*',
    schema: new OA\Schema(
        type: 'integer',
        default: 1
    )
)]
#[OA\QueryParameter(
    parameter: 'general--limit',
    name: 'limit',
    description: 'The current limit for the result set, defaults to *10*',
    schema: new OA\Schema(
        type: 'integer',
        default: 10
    )
)]
interface PaginationParameterObject
{
}
