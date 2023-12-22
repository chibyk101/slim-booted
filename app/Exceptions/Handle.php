<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpUnauthorizedException;

/**
 * @var \Slim\App $app
 */

$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails,
    ?LoggerInterface $logger = null
) use ($app) {
    if ($logger) {
        $logger->error($exception->getMessage());
    }

    $message = $exception->getMessage();
    $payload = compact('message');

    if ($exception instanceof ValidationException) {
        $payload = [
            'message' => $exception->getMessage(),
            'errors' => $exception->errors()
        ];
    }

    $statusCode = match (true) {
        $exception instanceof HttpNotFoundException => 404,
        $exception instanceof HttpForbiddenException => 403,
        $exception instanceof HttpInternalServerErrorException => 500,
        $exception instanceof HttpUnauthorizedException => 401,
        $exception instanceof ModelNotFoundException => 404,
        $exception instanceof ValidationException => 422,
        default => 500
    };

    if ($statusCode >= 500) {
        throw $exception;
    }


    $response = $app->getResponseFactory()->createResponse();

    $response->getBody()->write(
        json_encode($payload)
    );

    return $response->withHeader('content-type', 'application/json')->withStatus($statusCode);
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
