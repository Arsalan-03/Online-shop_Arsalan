<?php
namespace Model;

use PDO;
class Model
{
    protected PDO $pdo;
    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $dataBase = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $psw = getenv('DB_PASSWORD');

        $this->pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dataBase", $user, $psw);
    }
}