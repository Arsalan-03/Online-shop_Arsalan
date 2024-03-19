<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;

class CartController
{
    private UserProductRepository $userProduct;

    public function __construct()
    {
        $this->userProduct = new UserProductRepository();
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
                $totalPrice += $userProduct->getProduct()->getPrice() * $userProduct->getQuantity();
            }

        return $totalPrice;
    }
}