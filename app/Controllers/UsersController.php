<?php

namespace App\Controllers;


use App\Models\Users;

class UsersController
{
    public function show($container, $params)
    {
        $users = new Users($container); 
        $data = $users->get($params[1]);
        return json_encode(['data' => $data]); 
    }
}