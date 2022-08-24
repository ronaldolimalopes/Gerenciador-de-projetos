<?php

$composer = require __DIR__.'/vendor/autoload.php';

$modules = [
    __DIR__.'/app/Module.php' => 'App\Module'
];

$app = new Ronaldolopes\GerenciadorProjetos\App($composer, $modules);

$app->run();

