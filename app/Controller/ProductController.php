<?php

namespace Controller;

use Request\ProductRequest;
use Service\AuthenticationService\InterfaceAuthenticationService;
use Service\CartService;
use Service\ProductService;

class ProductController
{
    private ProductService $productService;
    private InterfaceAuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct(InterfaceAuthenticationService $authenticationService, ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->authenticationService = $authenticationService;
        $this->cartService = $cartService;
    }
    public function addProduct(ProductRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }
        $user = $this->authenticationService->getCurrentUser();
        $userId = $user->getId();

        $productId = $request->getProductId();
        $quantity = $request->getQuantity();

        $errors = $request->deleteValidate($userId);

        if (empty($errors)) {
            $this->cartService->addProduct($quantity, $productId);
            header("Location: /main");
        } else {
            $products = $this->productService->getAll();
            $totalPrice = $this->cartService->getTotalPrice();
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
        $productId = $request->getProductId();

        $errors = $request->addValidate($userId);

        if (empty($errors)) {
            $this->cartService->clearCartByUserIdProductId($productId);
            header("Location: /main");
        } else {
            $products = $this->productService->getAll();
            $totalPrice = $this->cartService->getTotalPrice();
            require_once './../View/main.php';
        }
    }
}