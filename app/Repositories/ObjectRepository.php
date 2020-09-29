<?php


namespace Farm\Repositories;


use Farm\Infrastructure\IDatabase;
use Farm\Models\ObjectModel;

class ObjectRepository
{
    protected IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }


    public function getOne($params):ObjectModel{

    }

    public function save(ObjectModel $model):void{

    }

    public function persist():bool{

    }
}