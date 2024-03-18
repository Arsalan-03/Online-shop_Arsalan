<?php
namespace Repository;

use Entity\Product;
use Entity\User;
use Repository\Repository;

class UserRepository extends Repository
{
    public function getOneByEmail(string $email): User|null
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        $user = $statement->fetch();

        if (empty($user)) {
            return null;
        }

        return $this->hydrate($user);
    }

    public function create(string $name, string $email, string $password)
    {
        $statement = $this->pdo->prepare("INSERT INTO users(name, email, password) VALUES (:name, :email, :password)");
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    }

    public function hydrate(array $data): User
    {
        return new User($data['id'], $data['name'], $data['email'], $data['password']);
    }
}