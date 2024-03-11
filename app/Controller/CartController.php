<?php

namespace Controller;

use Model\Product;
use Model\UserProduct;

class CartController
{
    private UserProduct $userProduct;

    public function __construct()
    {
        $this->userProduct = new UserProduct();
    }
    public function getCart(): void
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $userId = $_SESSION['user_id'];

            $userProducts = $this->userProduct->getAllUserProducts($userId);
            $totalPrice = $this->totalPrice($userProducts);

            require_once './../View/cart.php';
        }
    }

    public function totalPrice(array $userProducts): float
    {
        $totalPrice = 0;

            foreach ($userProducts as $userProduct) {
                $totalPrice += $userProduct['price'] * $userProduct['quantity'];
            }

        return $totalPrice;
    }
}