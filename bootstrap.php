<?php

use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;
use Ronaldolopes\GerenciadorProjetos\Router;
use Ronaldolopes\GerenciadorProjetos\Response;

require __DIR__.'/vendor/autoload.php';

$router = new Router;
require __DIR__.'/config/containers.php';
require __DIR__.'/config/routes.php';

try {
    
    $result = $router->run();
    
    $response = new Response;
    
    $params = [
        'container' => $container,
        'params' => $result['params'] 
    ];

    $response($result['callback'], $params);
    
} catch (HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}