<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;

class MainController
{
    private UserProduct $userProduct;
    private Product $productModel;

    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->productModel = new Product();
    }
    public function getProducts(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {

            $userId = $_SESSION['user_id'];
            $products = $this->productModel->getAll();
            $cartProducts = $this->userProduct->getAllUserProducts($userId);

            $totalQuantity = 0;
            foreach ($cartProducts as $cartProduct) {
                $totalQuantity += $cartProduct['quantity'];
            }
            require_once './../View/main.php';
        }
    }
}