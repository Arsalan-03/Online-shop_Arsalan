<?php
namespace Controller;

use Model\Product;
use Model\UserProduct;

require_once './../Model/UserProduct.php';
class UserProductController
{
    private UserProduct $userProduct;
    private Product $productModel;

    public function __construct()
    {
        $this->userProduct = new UserProduct();
        $this->productModel = new Product();
    }
    public function getAddProductForm(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        require_once './../View/add-product.php';
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

        $errors = $this->productValidate($data);

        if (empty($errors)) {

            $this->userProduct->addProduct($userId, $productId, $quantity);
            header("Location: /main");
        } else {
            require_once './../View/add-product.php';
        }
    }

    private function productValidate(array $data): array
    {
        $errors = [];

        if (isset($data['product_id'])) {
            $productId = $data['product_id'];

            if (!preg_match("/^[0-9]+$/", $data['product_id'])) {
                $errors['product_id'] = 'Некорректный product-id';
            } elseif (empty($this->productModel->getOneById($productId))) {
                $errors['product_id'] = "Такого продукта не существует";
            }
        } else {
            $errors['product-id'] = "Заполните поле product_id";
        }

        if (isset($data['quantity'])) {
            $quantity = $data['quantity'];

            if (!preg_match("/^[0-9]+$/", $data['quantity'])) {
                $errors['quantity'] = 'Неккоректный quantity';
            } elseif ($quantity <= '0') {
                $errors['quantity'] = "Вы ввели неверное значение";
            }
        } else {
            $errors['quantity'] = "Заполните поле quantity";
        }

        return $errors;
    }
}