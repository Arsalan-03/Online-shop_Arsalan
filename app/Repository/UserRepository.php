<?php
namespace Repository;

use Entity\Product;
use Entity\User;
use Repository\Repository;

class UserRepository extends Repository
{
    public function getOneByEmail(string $email): User|null
    {
        $statement = self::getPdo()->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        $user = $statement->fetch();

        if (empty($user)) {
            return null;
        }

        return $this->hydrate($user);
    }

    public function create(string $name, string $email, string $password): void
    {
        $statement = self::getPdo()->prepare("INSERT INTO users(name, email, password) VALUES (:name, :email, :password)");
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    public function getUserById(string $userId): User|null
    {
        $statement = self::getPdo()->prepare("SELECT * FROM users WHERE id = :id");
        $statement->execute(['id' => $userId]);

        $user = $statement->fetch();

        if (empty($user)) {
            return null;
        }

        return $this->hydrate($user);
    }

    public function hydrate(array $user): User
    {
        return new User($user['id'], $user['name'], $user['email'], $user['password']);
    }
}