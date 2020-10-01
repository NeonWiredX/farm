<?php

//TODO: need differentiation between singletons and fabrics
use Farm\Infrastructure\Logger;
use Farm\Infrastructure\MysqlDatabase;

return [
    'db' => [
        'class' => MysqlDatabase::class,
        'dsn'=>'mysql:host=127.0.0.1;dbname=farm',
        'username'=>'test',
        'password'=>'test'
    ],
    'logger' => [
        'class' => Logger::class,
        'path' => __DIR__ . '/../run/app.log'
    ],
];