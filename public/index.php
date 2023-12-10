<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

//Build Container
$container =  new DI\ContainerBuilder();
$container->useAttributes(true);
$container->addDefinitions(__DIR__ . '/../app/Config/definitions.php');
$container = $container->build();

//Create application
$app = \DI\Bridge\Slim\Bridge::create($container);

//Register routes
require_once __DIR__ . '/../app/Routes/api.php';
require_once __DIR__ . '/../app/Routes/web.php';

//load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

//Run Application
$app->run();
