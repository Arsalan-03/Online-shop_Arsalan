<?php
namespace Repository;

use Entity\Product;
use Entity\User;
use Entity\UserProduct;
use Repository\Repository;

class UserProductRepository extends Repository
{
    public function addProduct(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products(user_id, product_id, quantity) VALUES(:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function getOneByUserIdProductId(int $userId, int $productId): ?UserProduct
    {
        $stmt = $this->pdo->prepare("
        SELECT * FROM user_products 
        JOIN products ON user_products.product_id = products.id 
        JOIN users ON user_products.user_id = users.id 
        WHERE user_id=:user_id AND product_id=:product_id
    ");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        $product = $stmt->fetch();

        if (empty($product)) {
            return null;
        }

        $user = new User($product['id'], $product['name'], $product['email'], $product['password']);
        $productObj = new Product($product['id'], $product['product_name'], $product['product_image'], $product['product_info'], $product['product_price']);
        $userProductObj = new UserProduct($product['id'], $user, $productObj, $product['quantity']);

        return $userProductObj;
    }


    public function updateQuantityPlus(int $quantity, int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = (quantity + :quantity) WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['quantity' => $quantity, 'user_id' => $userId, 'product_id' => $productId]);
    }

    public function updateQuantityMinus(int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = (quantity - 1) WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    public function getCartProduct(int $userId): UserProduct|null
    {
        $stmt = $this->pdo->prepare("SELECT user_products.user_id, user_products.quantity, user_products.product_id FROM products
            JOIN user_products ON products.id = user_products.product_id 
            WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetchAll();

        if (empty($cart)) {
            return null;
        }

        return $this->hydrate($cart);
    }

    public function getAllUserProducts(int $userId): array
    {
       $stmt = $this->pdo->prepare("SELECT * FROM user_products 
         JOIN products ON user_products.product_id = products.id 
         JOIN users ON user_products.user_id = users.id 
         WHERE user_id=:user_id
         ");
       $stmt->execute(['user_id' => $userId]);
       $userProducts = $stmt->fetchAll();

       $array = [];
       foreach ($userProducts as $userProduct) {
           $user = new User($userProduct['id'], $userProduct['name'], $userProduct['email'], $userProduct['password']);
           $product = new Product($userProduct['id'], $userProduct['product_name'], $userProduct['product_image'], $userProduct['product_info'], $userProduct['product_price']);
           $userProductObj = new UserProduct($userProduct['id'], $user, $product, $userProduct['quantity']);

           $array[] = $userProductObj;
       }
       return $array;
    }

    public function deleteProducts(int $userId): array|false
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch();
    }

    public function hydrate(array $data): UserProduct
    {
        return new UserProduct($data['id'], $data['user_id'], $data['product_id'], $data['quantity']);
    }
}