<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;
use Service\AuthenticationService;
use Service\CartService;

class CartController
{
    private AuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct()
    {
        $this->authenticationService = new AuthenticationService();
        $this->cartService = new CartService();
    }
    public function getCart(): void
    {
       if (!$this->authenticationService->check()) {
            header("Location: /login");
        } else {
           $user = $this->authenticationService->getCurrentUser();
           $userId = $user->getId();

           $userProducts = $this->cartService->getProducts();
           $totalPrice = $this->cartService->getTotalPrice($userId);

            require_once './../View/cart.php';
        }
    }
}