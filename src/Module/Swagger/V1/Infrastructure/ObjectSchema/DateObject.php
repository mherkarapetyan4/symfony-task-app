<?php

declare(strict_types=1);

namespace App\Module\Swagger\V1\Infrastructure\ObjectSchema;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'DateObject',
    description: 'Date',
    type: 'string',
    example: '2023-12-12 12:12'
)]
interface DateObject
{
}
