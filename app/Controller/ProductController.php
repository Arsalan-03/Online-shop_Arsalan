<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;
use Request\ProductRequest;
use Service\AuthenticationService;
use Service\CartService;
use Service\ProductService;

class ProductController
{
    private ProductRepository $productModel;
    private AuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct()
    {
        $this->productModel = new ProductRepository();
        $this->authenticationService = new AuthenticationService();
        $this->cartService = new CartService();
    }
    public function addProduct(ProductRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }
        $user = $this->authenticationService->getCurrentUser();
        $userId = $user->getId();
        $productId = $request->getProduct();

        $quantity = $request->getQuantity();

        $errors = $request->validate($quantity);

        if (empty($errors)) {
            $this->cartService->addProduct($quantity, $productId);

            header("Location: /main");
        } else {

            $products = $this->productModel->getAll();
            require_once './../View/main.php';
        }
    }

    public function deleteProduct(ProductRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $user = $this->authenticationService->getCurrentUser();
        $userId = $user->getId();

        $productId = $request->getProduct();
        $this->cartService->clearCartByUserIdProductId($productId);

        header("Location: /main");
    }
}