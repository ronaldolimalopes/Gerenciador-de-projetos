<?php

use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;
use Ronaldolopes\GerenciadorProjetos\Router;
use Ronaldolopes\GerenciadorProjetos\Response;

require __DIR__.'/vendor/autoload.php';

$router = new Router;
require __DIR__.'/config/containers.php';
require __DIR__.'/config/Event.php';

$app = new Ronaldolopes\GerenciadorProjetos\App($container);
$router = $app->getRouter();
require __DIR__.'/config/Middlewares.php';
require __DIR__.'/config/routes.php';
$app->run();

