<?php
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

require __DIR__ . '/../vendor/autoload.php';

//load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//setup database
$capsule = new Capsule;
$capsule->addConnection(require __DIR__.'/../app/Config/database.php');
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = AppFactory::create();


//Register routes
require_once __DIR__ . '/../app/Routes/api.php';
require_once __DIR__ . '/../app/Routes/web.php';

//Register Exception Handler
require_once __DIR__ . '/../app/Exceptions/Handle.php';

//Run Application
$app->run();