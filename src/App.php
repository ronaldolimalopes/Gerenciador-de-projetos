<?php

namespace Ronaldolopes\GerenciadorProjetos; 

use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;
use Ronaldolopes\GerenciadorProjetos\Router;
use Ronaldolopes\GerenciadorProjetos\Response;

class App
{

    private $container;
    private $router;
    private $middlewares = [
        'before' => [],
        'after' => [] 
    ];
    public function __construct($router, $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function addMiddleware($on, $callback)
    {
        $this->middlewares[$on][] = $callback;
    }

    public function run()
    {
        try {
    
            $result = $this->router->run();
            
            $response = new Response;
            
            $params = [
                'container' => $this->container,
                'params' => $result['params'] 
            ];
        
            foreach ($this->middlewares['before'] as $middleware) {
                $middleware($this->container);
            }
        
            $response($result['callback'], $params);
        
            foreach ($this->middlewares['after'] as $middleware) {
                $middleware($this->container);
            }
            
        } catch (HttpException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
