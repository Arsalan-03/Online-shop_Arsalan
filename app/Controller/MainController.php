<?php
namespace Controller;
use Model\Product;
use Model\UserProduct;

require_once './../Model/Product.php';
require_once './../Model/UserProduct.php';
class MainController
{
    private UserProduct $userProduct;
    private Product $productModel;

    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->productModel = new Product();
    }
    public function getProducts()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {

           $products = $this->productModel->getAll();

            if (empty($products)) {
                echo '<h1 style="color: red">Продуктов в Таблице нет</h1>';
                die;
            }
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

            $this->userProduct->addProduct($userId, $productId, $quantity);
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