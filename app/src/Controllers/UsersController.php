<?php

namespace App\Controllers;
use Ronaldolopes\GerenciadorProjetos\CrudController;

class UsersController extends CrudController
{
    protected function getModel() : string
    {
        return 'users_model';
    }
    
   
}