<?php

namespace App\Module\Swagger\V1\Application\Action;

use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class SwaggerAction
{
    #[OA\Info(properties: [
        "title" => "My app",
        "version" => "0.1"
    ])]
    public function swaggerDocs(): Response
    {
        return new Response('');
    }

}