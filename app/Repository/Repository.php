<?php
namespace Repository;

use PDO;
class Repository
{
    protected static PDO $pdo;

    public static function getPdo(): PDO
    {
        if (isset(static::$pdo)) {
            return static::$pdo;
        }

        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $dataBase = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $psw = getenv('DB_PASSWORD');

        static::$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dataBase", $user, $psw);

        return static::$pdo;
    }
}