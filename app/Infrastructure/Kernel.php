<?php


namespace Farm\Infrastructure;


use Farm\Infrastructure\Exceptions\InvalidConfigurationException;
use http\Exception\RuntimeException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

class Kernel implements ContainerInterface
{

    protected array $singletones = [];

    public static Kernel $container;

    public function __construct(array $config, array $routes)
    {
        foreach ($config as $name => $params) {
            if (!array_key_exists('class', $params)) {
                throw new InvalidConfigurationException('No class parameter in config file');
            }
            $class = $params['class'];
            unset($params['class']);
            $service = new $class($params);
            $this->singletones[$name]=$service;
        }
        static::$container = $this;
    }


    public function processRequest()
    {

    }

    public function get($id)
    {
        if (!array_key_exists($id, $this->singletones)){
            throw new RuntimeException("There no ".$id." class in container!");
        }
        return $this->singletones[$id];
    }

    public function has($id): bool
    {
        return array_key_exists($id, $this->singletones);
    }

    //FAST GET

    public function db():IDatabase{
        if (!array_key_exists('db',$this->singletones)){
            throw new RuntimeException("There no db class in container!");
        }
        return $this->singletones['db'];
    }

    public function logger():LoggerInterface{
        if (!array_key_exists('logger',$this->singletones)){
            throw new RuntimeException("There no logger class in container!");
        }
        return $this->singletones['logger'];
    }

}