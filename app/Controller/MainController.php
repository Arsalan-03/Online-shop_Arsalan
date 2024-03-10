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

           $products = $this->productModel->getAll();

            require_once './../View/main.php';
        }
    }

    public function addProduct(array $data): void
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {

            header("Location: /login.php");
        }

        $userId = $_SESSION['user_id'];

        $productId = $data['product_id'];

        $quantity = $data['quantity'];

        $errors = $this->productValidate($quantity);

        if (empty($errors)) {

            if (empty($this->userProduct->getOnyByUserIdProductId($userId, $productId))) {
                $this->userProduct->addProduct($userId, $productId, $quantity);
            } else {
                $this->userProduct->updateQuantity($quantity, $userId, $productId);
            }

            header("Location: /main");
        } else {

            $products = $this->productModel->getAll();

            require_once './../View/main.php';
        }
    }

    private function productValidate(string $quantity): array
    {
        $errors = [];

        if ($quantity <= 0) {

            $errors['quantity'] = "Вы ввели неккоректное значение, попробуйте снова";

        }
        return $errors;
    }

    public function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_destroy();

            header("Location: /login");
        }
    }
}