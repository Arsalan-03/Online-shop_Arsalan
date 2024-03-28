<?php
namespace Controller;

use Service\AuthenticationService\InterfaceAuthenticationService;
use Service\CartService;
use Service\ProductService;

class MainController
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
    public function getProducts(): void
    {
       if (!$this->authenticationService->check()) {
            header("Location: /login");
        } else {
           $user = $this->authenticationService->getCurrentUser();
           $userId = $user->getId();

           $products = $this->productService->getAll();
           $totalQuantity = $this->cartService->getCountQuantity();

            require_once './../View/main.php';
        }
    }
}