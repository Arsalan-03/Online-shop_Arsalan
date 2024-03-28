<?php

namespace Repository;

class OrderProductRepository extends Repository
{

    public function addOrderProduct(int $userId, int $orderId): void
    {
        $statement = self::getPdo()->prepare("INSERT INTO order_products(order_id, user_id, product_id, quantity)
                    SELECT :order_id, :user_id, product_id, quantity
                    FROM user_products
                    WHERE user_id = :user_id");
        $statement->execute(['user_id' => $userId, 'order_id' => $orderId]);
    }
}