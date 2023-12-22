<?php

/**
 * API Routes
 * @var \Slim\App $app
 */

use Slim\Routing\RouteCollectorProxy;

$app->get('/', [\App\Controllers\IndexController::class, 'index']);

//list all users
$app->get('/users', [\App\Controllers\UserController::class, 'index']);
//group routes with common middleware
$app->group('', function (RouteCollectorProxy $group) {
    //create user
    $group->post('/users', [\App\Controllers\UserController::class, 'store']);
    //update user
    $group->put('/users/{id}', [\App\Controllers\UserController::class, 'update']);
})->add(\App\Middleware\JsonBodyParserMiddleware::class);
//get a single user
$app->get('/users/{user}', [\App\Controllers\UserController::class, 'show']);
//delete user
$app->delete('/users/{id}', [\App\Controllers\UserController::class, 'destroy']);
