<?php

require(__DIR__ . '../vendor/autoload.php');
$config = require(__DIR__.'../config/config.php');
$routes = require(__DIR__.'../routes/routes.php');

$app = new \Farm\Kernel($config,$routes);
//before this line can be preload

$app->processRequest();