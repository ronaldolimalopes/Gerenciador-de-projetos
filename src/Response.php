<?php

namespace Ronaldolopes\GerenciadorProjetos;

use Symfony\Component\HttpFoundation\Request;

class Response 
{
    public function __invoke($callback, $params)
    {

        parse_str(file_get_contents('php://input'), $_POST);
        
        $request = new Request(
            $_GET,
            $_POST,
            $params['params'],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );

        $params['params'] = $request;

        if(is_string($callback)){
            
            $callback = explode('::', $callback);
            $callback[0] = new $callback[0];
        }

       $response = call_user_func_array($callback, $params);
       
       if(is_array($response)){
            $response = json_encode($response);
       }
       
       echo $response;
    }
}