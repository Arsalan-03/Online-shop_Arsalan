<?php

namespace Model;

class OrderProduct extends Model
{
    public function addReadyOrder(int $orderId, int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products(order_id, user_id, product_id, quantity) VALUES (:order_id, :user_id, :product_id, :quantity)");
        $stmt->execute(['order_id' => $orderId, 'user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }
}