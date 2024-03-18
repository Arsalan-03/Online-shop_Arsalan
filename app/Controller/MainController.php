<?php
namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;

class MainController
{
    private UserProductRepository $userProduct;
    private ProductRepository $productModel;

    public function __construct()
    {
        $this->userProduct = new UserProductRepository();
        $this->productModel = new ProductRepository();
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