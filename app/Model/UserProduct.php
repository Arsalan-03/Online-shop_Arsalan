<?php
namespace Model;

use Model\Model;
require_once './../Model/Model.php';
class UserProduct extends Model
{
    public function addProduct(int $userId, int $productId, int $quantity)
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products(user_id, product_id, quantity) VALUES(:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }
}