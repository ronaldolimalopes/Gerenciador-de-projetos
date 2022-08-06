<?php

namespace Ronaldolopes\GerenciadorProjetos;
use Ronaldolopes\GerenciadorProjetos\Exceptions\HttpException;

class Router
{
    private $routes = [];

    public function add(string $method,string $pattern, $callback)
    {
        $method = strtolower($method);
        $pattern = '/^'. str_replace('/', '\/', $pattern) .'$/';
        $this->routes[$method][$pattern] = $callback;
    }
    
    public function getCurrentUrl()
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';

        if(strlen($url) > 1){
            $url = rtrim($url, '/');
        }
        return $url;
    }

    public function run()
    {
        $url = $this->getCurrentUrl();
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if(empty($this->routes[$method])){
            throw new HttpException('Page not found', 404);
        }

        foreach ($this->routes[$method] as $route => $callback) {
            if(preg_match($route, $url, $params)){
                return $callback($params);
            }
        }
        
        throw new HttpException('Page not Found', 404);
    }
}