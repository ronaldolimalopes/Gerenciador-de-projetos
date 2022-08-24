<?php

namespace App\Controllers;


use App\Models\Users;

class UsersController
{
    public function index($container,$request)
    { 
        $users = new Users($container);
        return $users->all();
    }

    public function show($container, $request)
    { 
        $users = new Users($container);
        $data = $users->get($request->attributes->get(1));
        return json_encode(['data' => $data]); 
    }

    public function create($container, $request)
    { 
        $users = new Users($container);
        return $users->create($request->request->all());
    }

    public function update($container, $request)
    { 
        $users = new Users($container);
        return $users->update($request->attributes->get(1), $request->request->all());
    }

    public function delete($container, $request)
    { 
        $users = new Users($container);
        return $users->delete($request->attributes->get(1));
    }
}