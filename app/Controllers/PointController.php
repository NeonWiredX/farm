<?php


namespace Farm\Controllers;


use Farm\Infrastructure\AController;
use Farm\Infrastructure\Kernel;

class PointController extends AController
{

    public function index(){
        Kernel::$container->logger()->info("index");
        $this->response->plainText="test2";
    }
    public function view(){
        Kernel::$container->logger()->info("view");
        $this->response->plainText="view";
    }
    public function create(){
        Kernel::$container->logger()->info("create");
        $this->response->plainText="create";
    }
    public function delete(){
        Kernel::$container->logger()->info("delete");
        $this->response->plainText="delete";
    }
    public function update(){
        Kernel::$container->logger()->info("update");
        $this->response->plainText="update";
    }

}