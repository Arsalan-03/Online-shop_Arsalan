<?php

namespace Model;

class OrderProduct extends Model
{
    public function addReadyOrder(int $orderId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products(order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId, 'quantity' => $quantity]);
    }
}