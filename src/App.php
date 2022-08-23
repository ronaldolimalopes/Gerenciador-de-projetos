<?php

namespace Ronaldolopes\GerenciadorProjetos; 

use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;
use Ronaldolopes\GerenciadorProjetos\Router;
use Ronaldolopes\GerenciadorProjetos\Response;

class App
{

    private $container;
    private $middlewares = [
        'before' => [],
        'after' => [] 
    ];
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function addMiddleware($on, $callback)
    {
        $this->middlewares[$on][] = $callback;
    }

    public function getRouter()
    {
        if(!$this->container->offsetExists('router')){
            $this->container['router'] = function(){
                return new Router;
            };
        }
        return $this->container['router'];
    }

    public function run()
    {
        try {
    
            $result = $this->getRouter()->run();
            
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
