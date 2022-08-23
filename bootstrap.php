<?php

use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;
use Ronaldolopes\GerenciadorProjetos\Router;
use Ronaldolopes\GerenciadorProjetos\Response;

require __DIR__.'/vendor/autoload.php';

$router = new Router;
require __DIR__.'/config/containers.php';
require __DIR__.'/config/Middlewares.php';
require __DIR__.'/config/Event.php';
require __DIR__.'/config/routes.php';

try {
    
    $result = $router->run();
    
    $response = new Response;
    
    $params = [
        'container' => $container,
        'params' => $result['params'] 
    ];

    foreach ($middlewares['before'] as $middleware) {
        $middleware($container);
    }

    $response($result['callback'], $params);

    foreach ($middlewares['after'] as $middleware) {
        $middleware($container);
    }
    
} catch (HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}