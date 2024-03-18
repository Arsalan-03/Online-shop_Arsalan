<?php
namespace Model;

use Entity\UserEntity;
use Model\Model;

class User extends Model
{
    public function getOneByEmail(string $email): UserEntity|null
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        $user = $statement->fetch();

        if (empty($user)) {
            return null;
        }

        return new UserEntity($user['id'], $user['name'], $user['email'], $user['password']);
    }

    public function create(string $name, string $email, string $password)
    {
        $statement = $this->pdo->prepare("INSERT INTO users(name, email, password) VALUES (:name, :email, :password)");
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

}