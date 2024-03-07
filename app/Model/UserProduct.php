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

    public function checkUserByUserId(int $userId, int $productId): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        return $stmt->fetchAll();
    }

    public function updateProduct(int $quantity, int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = :quantity + quantity WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['quantity' => $quantity, 'user_id' => $userId, 'product_id' => $productId]);
    }
}