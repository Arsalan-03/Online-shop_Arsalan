<?php
namespace Repository;

use Entity\Product;
use Repository\Repository;

class ProductRepository extends Repository
{
    public function getAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM products");
        $products = $statement->fetchAll();

        $result = [];
        foreach ($products as $product) {
           $result[] = $this->hydrate($product);
        }

        return $result;
    }

    public function hydrate(array $data): Product
    {
        return new Product($data['id'], $data['product_name'], $data['product_image'], $data['product_info'], $data['product_price']);
    }
}