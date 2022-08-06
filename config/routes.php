<?php

use App\Models\Users;

$router->add('GET', '/', function() use ($container){
    $users = new Users($container); 
    $data = $users->get(1);
    var_dump($data);
    return "Estamos na homepage";
});

$router->add('GET', '/projects/(\d+)', function($params){
    return "Estamos listando os projetos, cod: ".$params[1];
});