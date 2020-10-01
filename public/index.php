<?php

require( __DIR__ . '/../vendor/autoload.php' );
$config = require( __DIR__ . '/../config/config.php' );
$routes = require( __DIR__ . '/../routes/routes.php' );
spl_autoload_register( [ \Farm\Infrastructure\Kernel::class, 'autoload' ], true, true );
try {
    $app = new \Farm\Infrastructure\Kernel( $config, $routes );
} catch (\Farm\Infrastructure\Exceptions\InvalidConfigurationException $e) {
    var_dump( $e );
    die;
}
//TODO: before this line can be preload
//TODO: no error handling yet
$app->processRequest();