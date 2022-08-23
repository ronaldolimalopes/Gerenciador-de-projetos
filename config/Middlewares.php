<?php

$middlewares = [
    'before' => [
        function($c)
        {
            echo 'before 1';
        },
        function($c)
        {
            echo 'Before 2';
        }
    ],
    'after' => [
        function($c)
        {
            echo 'After 1';
        },
        function($c)
        {
            echo 'After 2';
        }
    ]
];
