<?php

namespace App\Controllers;

use Slim\Psr7\Response;

class Controller
{

    public function successResponse(Response $response, int $status = 200)
    {
        return $response->withHeader('Content-Type', 'Application/json')->withStatus($status);
    }

    public function errorResponse(Response $response, int $status = 400)
    {
        return $response->withHeader('Content-Type', 'Application/json')->withStatus($status);
    }
}
