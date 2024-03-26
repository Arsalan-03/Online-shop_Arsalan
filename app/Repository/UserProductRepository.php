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
        $stmt = self::getPdo()->prepare("INSERT INTO user_products(user_id, product_id, quantity) VALUES(:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function getOneByUserIdProductId(int $userId, int $productId): UserProduct|null
    {
        $stmt = self::getPdo()->prepare("SELECT up.id AS id, u.id AS user_id, u.name AS user_name, u.email, u.password, 
        p.id AS product_id, p.name AS product_name, p.image, p.info, p.price, up.quantity FROM user_products up
        JOIN users u ON up.user_id = u.id
        JOIN products p ON up.product_id = p.id
        WHERE u.id = :user_id AND p.id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        $product = $stmt->fetch();

        if (empty($product)) {
            return null;
        }
        return $this->hydrate($product);
    }


    public function updateQuantityPlus(int $quantity, int $userId, int $productId): void
    {
        $stmt = self::getPdo()->prepare("UPDATE user_products SET quantity = (quantity + :quantity) WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['quantity' => $quantity, 'user_id' => $userId, 'product_id' => $productId]);
    }

    public function updateQuantityMinus(int $userId, int $productId): void
    {
        $stmt = self::getPdo()->prepare("UPDATE user_products SET quantity = (quantity - 1) WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    public function getCartProduct(int $userId): UserProduct|null
    {
        $stmt = self::getPdo()->prepare("SELECT user_products.user_id, user_products.quantity, user_products.product_id FROM products
            JOIN user_products ON products.id = user_products.product_id 
            WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetchAll();

        if (empty($cart)) {
            return null;
        }

        return new UserProduct($cart['id'], $cart['user_id'], $cart['product_id'], $cart['quantity']);
    }

    public function getAllUserProducts(int $userId): array
    {
        $stmt = self::getPdo()->prepare("SELECT up.id AS id, u.id AS user_id, u.name AS user_name, u.email, u.password, 
        p.id AS product_id, p.name AS product_name, p.image, p.info, p.price, up.quantity FROM user_products up
        JOIN users u ON up.user_id = u.id
        JOIN products p ON up.product_id = p.id
        WHERE u.id = :user_id;");
       $stmt->execute(['user_id' => $userId]);
       $userProducts = $stmt->fetchAll();

       $array = [];
       foreach ($userProducts as $userProduct) {
           $array[$userProduct['product_id']] = $this->hydrate($userProduct);
       }
       return $array;
    }

    public function deleteProducts(int $userId): array|false
    {
        $stmt = self::getPdo()->prepare("DELETE FROM user_products WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch();
    }

    public function hydrate(array $userProduct): UserProduct
    {
        return new UserProduct($userProduct['id'],
            new User($userProduct['user_id'],$userProduct['user_name'],$userProduct['email'],$userProduct['password']),
            new Product($userProduct['product_id'],$userProduct['product_name'],$userProduct['image'],$userProduct['info'],$userProduct['price']),
            $userProduct['quantity']);
    }

}