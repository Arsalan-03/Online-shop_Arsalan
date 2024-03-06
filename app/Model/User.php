<?php
namespace Model;

use Model\Model;

class User extends Model
{
    public function getOneByEmail(string $email): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        return $statement->fetch();
    }

    public function create(string $name, string $email, string $password)
    {
        $statement = $this->pdo->prepare("INSERT INTO users(name, email, password) VALUES (:name, :email, :password)");
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

}