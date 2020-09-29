<?php


namespace Farm\Infrastructure;


use Farm\Infrastructure\Exceptions\InvalidConfigurationException;
use http\Exception\RuntimeException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

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
            $service = new $params['class']();
            //TODO: ridiculously stupid
            unset($params['class']);
            foreach ($params as $key=>$value){
                $service->{$key}=$value;
            }
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


}