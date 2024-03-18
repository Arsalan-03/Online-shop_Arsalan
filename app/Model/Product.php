<?php
namespace Model;

use Entity\ProductEntity;
use Model\Model;

class Product extends Model
{
    public function getAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM products");
        $products = $statement->fetchAll();

        $result = [];
        foreach ($products as $product) {
           $result[] =  new ProductEntity($product['id'], $product['name'], $product['image'], $product['info'], $product['price']);
        }
        return $result;
    }
}