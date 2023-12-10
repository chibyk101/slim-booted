<?php

// MIT License

// Copyright (c) 2023 Chibuike Umezinwa

// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:

// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

//Build Container
$container =  new DI\ContainerBuilder();

//should incase you need to use attributes to inject dependencies
// you can change this to false or remove line of code
$container->useAttributes(true);

//add definitions
$container->addDefinitions(__DIR__ . '/../app/Config/definitions.php');

//build container for registration
$container = $container->build();

//Create application
$app = \DI\Bridge\Slim\Bridge::create($container);

//Register routes
require_once __DIR__ . '/../app/Routes/api.php';
require_once __DIR__ . '/../app/Routes/web.php';

//load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//Run Application
$app->run();
