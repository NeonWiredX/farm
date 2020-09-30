<?php


namespace Farm\Infrastructure;


use Farm\Infrastructure\Exceptions\InvalidConfigurationException;
use PDO;
use PDOException;

class MysqlDatabase implements IDatabase {
    protected PDO $pdo;

    public function __construct(array $params) {
        if (!array_key_exists( 'dsn', $params )) {
            throw new InvalidConfigurationException( 'no dsn provided' );
        }

        if (!array_key_exists( 'username', $params )) {
            throw new InvalidConfigurationException( 'no username provided' );
        }

        if (!array_key_exists( 'password', $params )) {
            throw new InvalidConfigurationException( 'no password provided' );
        }
        $opt = [ PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                 PDO::ATTR_EMULATE_PREPARES => false, ];


        try {
            $this->pdo = new PDO( $params['dsn'], $params['username'], $params['password'], $opt );
        } catch (PDOException $e) {
            throw new InvalidConfigurationException( "invalid dsn" );
        }
    }

    public function query(string $request, array $placeholders = []): array {
        $prep = $this->pdo->prepare($request);
        return $prep->fetchAll();
    }

    public function exec(string $request, array $placeholders = []) {
        $prep = $this->pdo->prepare($request);
        $prep->execute($placeholders);
    }
}