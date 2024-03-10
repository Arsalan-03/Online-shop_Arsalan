<?php
namespace Model;

use Model\Model;

class Product extends Model
{
    public function getAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM products");
        $products = $statement->fetchAll();

        return $products;
    }

    public function getOneById(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        return $result;
    }
}