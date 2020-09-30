<?php


namespace Farm\Infrastructure;


use PDO;

class MysqlDatabase implements IDatabase
{
    protected PDO $pdo;

    public function __construct(array $params)
    {

    }

}