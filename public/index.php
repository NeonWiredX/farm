<?php

require(__DIR__ . '../vendor/autoload.php');
$config = require(__DIR__.'../config/config.php');
$routes = require(__DIR__.'../routes/routes.php');

$app = new \Farm\Infrastructure\Kernel($config,$routes);
//TODO: before this line can be preload
//TODO: no error handling yet
$app->processRequest();