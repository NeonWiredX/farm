<?php


namespace Farm\Infrastructure;


use Farm\Infrastructure\Exceptions\InvalidConfigurationException;
use http\Exception\RuntimeException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class Kernel implements ContainerInterface {

    public static Kernel $container;
    protected array      $singletones = [];
    protected array      $routes      = [];

    public function __construct(array $config, array $routes) {

        foreach ($config as $name => $params) {
            if (!array_key_exists( 'class', $params )) {
                throw new InvalidConfigurationException( 'No class parameter in config file' );
            }

            $class = $params['class'];
            unset( $params['class'] );
            $service = new $class( $params );
            $this->singletones[$name] = $service;

        }

        foreach ($routes as $routeName=>$route){
            $this->routes[$routeName]=$this->parseUrl($route);
        }

        static::$container = $this;

    }

    public static function autoload($className) {

        $rootPath = __DIR__ . "/../";
        if (strpos( $className, '\\' ) !== false) {
            $classFile = str_replace( '\\', '/', $className ) . '.php';
            if (strpos( $classFile, 'Farm/' ) === 0) {
                $classFile = mb_substr( $classFile, 5 ); //remove root loader
            }
            $classFile = $rootPath . $classFile;
            if ($classFile === false || !is_file( $classFile )) {
                return;
            }
        } else {
            return;
        }

        include $classFile;

        if (!class_exists( $className, false ) && !interface_exists( $className, false )) {
            throw new InvalidConfigurationException( "Unable to find '$className' in file: $classFile. Namespace missing?" );
        }
    }

    public function processRequest() {
        //TODO: create separate router
        $request = new Request();
        $response = new Response();
        $requestPath  = $_SERVER['REQUEST_URI'];
        var_dump($_SERVER);
    }


    public function get($id) {
        if (!array_key_exists( $id, $this->singletones )) {
            throw new RuntimeException( "There no " . $id . " class in container!" );
        }
        return $this->singletones[$id];
    }

    public function has($id): bool {
        return array_key_exists( $id, $this->singletones );
    }

    //FAST GET

    public function db(): IDatabase {
        if (!array_key_exists( 'db', $this->singletones )) {
            throw new RuntimeException( "There no db class in container!" );
        }
        return $this->singletones['db'];
    }

    public function logger(): LoggerInterface {
        if (!array_key_exists( 'logger', $this->singletones )) {
            throw new RuntimeException( "There no logger class in container!" );
        }
        return $this->singletones['logger'];
    }

    protected function parseUrl($url) {
        $splitted = explode('@',$url);
        $fullClass = "Farm/Controllers/".$splitted[0];
        return [
            'class'=>$fullClass,
            'action'=>$splitted[1]
        ];
    }

}