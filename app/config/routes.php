<?php

$router->add('GET', '/', function(){
    return "estamos na homepage";
});

$router->add('GET', '/users', 'App\Controllers\UsersController::index');
$router->add('GET', '/users/(\d+)', 'App\Controllers\UsersController::show');
$router->add('POST', '/users', 'App\Controllers\UsersController::create');
$router->add('PUT', '/users/(\d+)', 'App\Controllers\UsersController::update');
$router->add('DELETE', '/users/(\d+)', 'App\Controllers\UsersController::delete');

// $router->add('GET', '/projects/(\d+)', function($params){
//     return "Estamos listando os projetos, cod: ".$params[1];
// });