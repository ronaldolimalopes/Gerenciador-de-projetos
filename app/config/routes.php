<?php

use App\Models\Users;
use App\Controllers\UsersController;

$router->add('GET', '/users/(\d+)', 'App\Controllers\UsersController::show');

$router->add('GET', '/projects/(\d+)', function($params){
    return "Estamos listando os projetos, cod: ".$params[1];
});