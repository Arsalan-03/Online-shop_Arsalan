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

            require_once './../View/cart.php';
        }

        if (empty($userProducts)) {
            echo "Корзина пустая";
        }
    }
}