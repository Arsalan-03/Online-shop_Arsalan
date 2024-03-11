<?php
namespace Model;

use Model\Model;

class UserProduct extends Model
{
    public function addProduct(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products(user_id, product_id, quantity) VALUES(:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function getOneByUserIdProductId(int $userId, int $productId): array|bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        return $stmt->fetch();
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

    public function getAllByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getAllUserProducts(int $userId): array|false
    {
       $stmt = $this->pdo->prepare("SELECT name, image, price, user_products.quantity FROM products JOIN user_products ON products.id = user_products.product_id WHERE user_id=:user_id");
       $stmt->execute(['user_id' => $userId]);

       return $stmt->fetchAll();
    }

    public function deleteProduct(int $userId, int $productId): array|false
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id=:user_id AND product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        return $stmt->fetch();
    }
}