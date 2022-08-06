<?php

use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;
use Ronaldolopes\GerenciadorProjetos\Router;

require __DIR__.'/vendor/autoload.php';

$router = new Router;
require __DIR__.'/config/containers.php';
require __DIR__.'/config/routes.php';

try {
    echo $router->run();
} catch (HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}