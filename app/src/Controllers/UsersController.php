<?php

namespace App\Controllers;


use App\Models\Users;

class UsersController
{
    public function show($container, $request)
    { 
        $users = new Users($container);
        $users->create(['nome' => 'Ronaldo Lopes']); 
        $data = $users->get($request->attributes->get(1));
        return json_encode(['data' => $data]); 
    }
}