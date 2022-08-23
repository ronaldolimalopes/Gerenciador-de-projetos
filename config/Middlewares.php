<?php

$app->addMiddleware('before', function (){
    echo 'Before 1';
});

$app->addMiddleware('after', function (){
    echo 'After 1';
});
