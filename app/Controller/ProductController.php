<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;
use Request\ProductRequest;

class ProductController
{
    private UserProductRepository $userProduct;
    private ProductRepository $productModel;

    public function __construct()
    {
        $this->userProduct = new UserProductRepository();
        $this->productModel = new ProductRepository();
    }
    public function addProduct(ProductRequest $request): void
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {

            header("Location: /login.php");
        }

        $userId = $_SESSION['user_id'];

        $productId = $request->getProduct();

        $quantity = $request->getQuantity();

        $errors = $request->validate($quantity);

        if (empty($errors)) {

            if (empty($this->userProduct->getOneByUserIdProductId($userId, $productId))) {
                $this->userProduct->addProduct($userId, $productId, $quantity);
            } else {
                $this->userProduct->updateQuantityPlus($quantity, $userId, $productId);
            }

            header("Location: /main");
        } else {

            $products = $this->productModel->getAll();
            require_once './../View/main.php';
        }
    }

    public function deleteProduct(ProductRequest $request): void
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $userId = $_SESSION['user_id'];
        $productId = $request->getProduct();

        $this->userProduct->updateQuantityMinus($userId, $productId);

        header("Location: /main");
    }
}