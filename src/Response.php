<?php

namespace Ronaldolopes\GerenciadorProjetos;

class Response 
{
    public function __invoke($callback, $params)
    {

        if(is_string($callback)){
            
            $callback = explode('::', $callback);
            $callback[0] = new $callback[0];
        }
        
       echo call_user_func_array($callback, $params);
    }
}